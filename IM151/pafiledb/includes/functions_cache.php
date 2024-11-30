<?php
/***************************************************************************
 *                              acm_file.php
 *                            -------------------
 *   begin                : Saturday, Feb 13, 2001
 *   copyright            : (C) 2001 The phpBB Group
 *   email                : support@phpbb.com
 *
 *   $Id: acm_file.php,v 1.5 2003/07/17 15:16:11 psotfx Exp $
 *
 ***************************************************************************/

/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 ***************************************************************************/

	class acm
{
    var $vars = '';
    var $vars_ts = array();
    var $modified = FALSE;
    protected $cache_dir; // Declare the property here
 
    function __construct()
    {
        global $phpbb_root_path;
        $this->cache_dir = $phpbb_root_path . 'pafiledb/cache/';
    }

	function load()
	{
		global $phpEx;
		@include($this->cache_dir . 'data_global.' . $phpEx);
	}

	function unload()
	{
		$this->save();
		unset($this->vars);
		unset($this->vars_ts);
	}

	function save() 
	{
		if (!$this->modified)
		{
			return;
		}

		global $phpEx;
		$file = '<?php $this->vars=' . $this->format_array($this->vars) . ";\n\$this->vars_ts=" . $this->format_array($this->vars_ts) . ' ?>';

		if ($fp = @fopen($this->cache_dir . 'data_global.' . $phpEx, 'wb'))
		{
			@flock($fp, LOCK_EX);
			fwrite($fp, $file);
			@flock($fp, LOCK_UN);
			fclose($fp);
		}
	}

	function tidy($expire_time = 0)
	{
		global $phpEx;

		$dir = opendir($this->cache_dir);
		while ($entry = readdir($dir))
		{
			if ($entry[0] == '.' || substr($entry, 0, 4) != 'sql_')
			{
				continue;
			}

			if (time() - $expire_time >= filemtime($this->cache_dir . $entry))
			{
				unlink($this->cache_dir . $entry);
			}
		}

		if (file_exists($this->cache_dir . 'data_global.' . $phpEx))
		{
			foreach ($this->vars_ts as $varname => $timestamp)
			{
				if (time() - $expire_time >= $timestamp)
				{
					$this->destroy($varname);
				}
			}
		}
		else
		{
			$this->vars = $this->vars_ts = array();
			$this->modified = TRUE;
		}
	}

	function get($varname, $expire_time = 0)
	{
		return ($this->exists($varname, $expire_time)) ? $this->vars[$varname] : NULL;
	}

	function put($varname, $var)
	{
		$this->vars[$varname] = $var;
		$this->vars_ts[$varname] = time();
		$this->modified = TRUE;
	}

	function destroy($varname)
	{
		if (isset($this->vars[$varname]))
		{
			$this->modified = TRUE;
			unset($this->vars[$varname]);
			unset($this->vars_ts[$varname]);
		}
	}

	function exists($varname, $expire_time = 0)
	{
		if (!is_array($this->vars))
		{
			$this->load();
		}

		if ($expire_time > 0 && isset($this->vars_ts[$varname]))
		{
			if ($this->vars_ts[$varname] <= time() - $expire_time)
			{
				$this->destroy($varname);
				return FALSE;
			}
		}

		return isset($this->vars[$varname]);
	}

	function format_array($array)
	{
		$lines = array();
		foreach ($array as $k => $v)
		{
			if (is_array($v))
			{
				$lines[] = "'$k'=>" . $this->format_array($v);
			}
			elseif (is_int($v))
			{
				$lines[] = "'$k'=>$v";
			}
			elseif (is_bool($v))
			{
				$lines[] = "'$k'=>" . (($v) ? 'TRUE' : 'FALSE');
			}
			else
			{
				$lines[] = "'$k'=>'" . str_replace("'", "\'", str_replace('\\', '\\\\', $v)) . "'";
			}
		}
		return 'array(' . implode(',', $lines) . ')';
	}
}
?>
