<?php
/**
*
* @package EasyMOD_parser
* @version $Id: parser_xml.php 134 2008-06-24 19:38:23Z terrafrost $
* @copyright (c) 2005 phpBB Group
* @license http://opensource.org/licenses/gpl-license.php GNU General Public License
*
*/

/**
* @package EasyMOD_parser
* Parser for the XML MOD template
*/
class mod_parser_xml
{
	/**
	* Contents of the MOD to be parsed.
	* @type string
	*/
	var $mod_contents;

	/**
	* Valid MOD actions.
	* @type array
	*/
	var $valid_actions = array();

	/**
	* Header parts from the MOD
	* @type array
	*/
	var $header = array();

	/**
	* Actions for the MOD
	* @type array
	*/
	var $actions = array();

	/**
	* Parsed XML file in an array
	* @type array
	*/
	var $data = array();
	
	var $indexes = array();

	/**
	* XML parser resource
	* @type resource
	*/
	var $parser;

	/**
	* MODX version
	* @type string
	*/
	var $modx_version;

	/**
	* Constructor
	*
	* @access public
	* @param string Filename
	*/
	function mod_parser_xml($mod_contents)
	{
		$this->mod_contents = str_replace(array("\r\n", "\r", "\n"), "\n", trim($mod_contents));
	}

	function _parse()
	{
		$XML = $this->mod_contents;

		$this->parser = xml_parser_create();
		xml_set_object($this->parser, $this);
		xml_set_element_handler($this->parser, '_tag_open', '_tag_closed');
		xml_set_character_data_handler($this->parser, '_tag_data');

		//$XML = str_replace('&lt;', '<![CDATA[&lt;]]>', $XML);
		//$XML = str_replace('&gt;', '<![CDATA[&gt;]]>', $XML);
		//$XML = preg_replace('#<!\[CDATA\[(.*)<!\[CDATA\[(.*)\]\]>#is', '\\1\\2', $XML);
		if(!xml_parse($this->parser, $XML))
		{
			die(sprintf('XML error: %s at line %d', xml_error_string(xml_get_error_code($this->parser)), xml_get_current_line_number($this->parser)));
		}

		xml_parser_free($this->parser);

		$this->modx_version = substr(basename($this->data[0]['attrs']['XMLNS']), 5, -4);

		return $this->data;
	}
	
	function _parse_into_struct()
	{
		$this->parser = xml_parser_create();
		
		xml_parse_into_struct($this->parser, $this->mod_contents, $this->data, $this->indexes);
		
		echo '<pre>';
		var_dump($this->data);
		echo '</pre><pre>';
		var_dump($this->indexes);
		echo '</pre>';
		
		xml_parser_free($this->parser);
	}

	function _tag_open($parser, $name, $attrs)
	{
		$tag = array('name' => $name, 'attrs' => $attrs);
		array_push($this->data, $tag);
	}

	function _tag_data($parser, $tag_data)
	{
		if(!empty($tag_data))
		{
			if(isset($this->data[count($this->data)-1]['data']))
			{
				$this->data[count($this->data)-1]['data'] .= $tag_data;
			}
			else
			{
				$this->data[count($this->data)-1]['data'] = $tag_data;
			}
		}
	}

	function _tag_closed($parser, $name)
	{
		$this->data[count($this->data)-2]['children'][$name][] = $this->data[count($this->data)-1];
		array_pop($this->data);
	}

	/**
	* Returns array of MOD header information
	*/
	function parse_header()
	{
		if(empty($this->data))
		{
			$this->_parse();
		}

		$header_info = $this->data[0]['children']['HEADER'][0]['children'];

		// Name and decription
		// @TODO check lang attribute to see if it is the correct language
		$this->header['name'] = trim($header_info['TITLE'][0]['data']);
		$this->header['desc'] = trim($header_info['DESCRIPTION'][0]['data']);
		$this->header['author-notes'] = trim($header_info['AUTHOR-NOTES'][0]['data']);
		$this->header['install-level'] = trim($header_info['INSTALLATION'][0]['children']['LEVEL'][0]['data']);
		$this->header['install-time'] = intval($header_info['INSTALLATION'][0]['children']['TIME'][0]['data']);
		$this->header['license'] = ( !empty($header_info['LICENSE'][0]['data']) ) ? $header_info['LICENSE'][0]['data'] : 'blah';

		// Version
		switch ($this->modx_version)
		{
			case '1.0':
				$version_info = $header_info['MOD-VERSION'][0]['children'];
				$this->header['version'] = ( isset($version_info['MAJOR'][0]['data']) ) ? trim($version_info['MAJOR'][0]['data']) : 0;
				$this->header['version'] .= '.' . (( isset($version_info['MINOR'][0]['data']) ) ? trim($version_info['MINOR'][0]['data']) : 0);
				$this->header['version'] .= '.' . (( isset($version_info['REVISION'][0]['data']) ) ? trim($version_info['REVISION'][0]['data']) : 0);
				$this->header['version'] .= (isset($version_info['RELEASE'][0]['data'])) ? $version_info['RELEASE'][0]['data'] : '';
				break;
			case '1.2.0':
				$this->header['version'] = $header_info['MOD-VERSION'][0]['data'];
				break;
			default:
				return;
		}

		// author
		$author_info = $header_info['AUTHOR-GROUP'][0]['children']['AUTHOR'];
		for($i = 0, $total = sizeof($author_info); $i < $total; $i++)
		{
			$this->header['author'][] = array(
				'username'	=> trim($author_info[$i]['children']['USERNAME'][0]['data']),
				'email'		=> trim($author_info[$i]['children']['EMAIL'][0]['data']),
				'realname'	=> trim($author_info[$i]['children']['REALNAME'][0]['data']),
				'website'	=> trim($author_info[$i]['children']['HOMEPAGE'][0]['data']));
		}

		// history
		$history_info = $header_info['HISTORY'][0]['children']['ENTRY'];
		for($i = 0, $total = sizeof($history_info); $i < $total; $i++)
		{
			$changes	= array();
			$entry		= $history_info[$i]['children'];
			$changelog	= $entry['CHANGELOG'][0]['children']['CHANGE'];

			for($j = 0, $change_total = sizeof($changelog); $j < $change_total; $j++)
			{
				$changes[] = $changelog[$j]['data'];
			}

			switch ($this->modx_version)
			{
				case '1.0':
					$version	= $entry['REV-VERSION'][0]['children'];
					$this->header['history'][] = array(
						'date'		=> $entry['DATE'][0]['data'],
						'version'	=> intval($version['MAJOR'][0]['data']) . '.' . intval($version['MINOR'][0]['data']) . '.' . intval($version['REVISION'][0]['data']) . $version['RELEASE'][0]['data'],
						'change'	=> $changes,
					);
					break;
				case '1.2.0':
					$this->header['history'][] = $header_info['MOD-VERSION'][0]['data'];
					break;
				default:
					return;
			}
		}

		return $this->header;
	}

	function parse_actions()
	{
		if(empty($this->data))
		{
			$this->_parse();
		}

		$actions = $this->data[0]['children']['ACTION-GROUP'][0]['children'];

		// sql
		$sql_info = ( !empty($actions['SQL']) ) ? $actions['SQL'] : array();;
		for( $i = 0, $total = sizeof($sql_info); $i < $total; $i++ )
		{
			$this->actions['sql'][] = ( !empty($sql_info[$i]['data']) ) ? trim($sql_info[$i]['data']): '';
		}
		
		// diy instructions
		$diy_info = ( !empty($actions['DIY-INSTRUCTIONS']) ) ? $actions['DIY-INSTRUCTIONS'] : array();;
		for( $i = 0, $total = sizeof($diy_info); $i < $total; $i++ )
		{
			$this->actions['diy-instructions'][] = ( !empty($diy_info[$i]['data']) ) ? trim($diy_info[$i]['data']): '';
		}

		// copy
		$copy_info = ( !empty($actions['COPY']) ) ? $actions['COPY'] : array();
		for( $i = 0, $total = sizeof($copy_info); $i < $total; $i++ )
		{
			$copy_files = $copy_info[$i]['children']['FILE'];
			for( $j = 0, $file_total = sizeof($copy_files); $j < $file_total; $j++ )
			{
				$this->actions['copy'][] = array(
					'from'	=> str_replace('\\', '/', $copy_files[$j]['attrs']['FROM']),
					'to'	=> str_replace('\\', '/', $copy_files[$j]['attrs']['TO']));
			}
		}

		// open
		$open_info = ( !empty($actions['OPEN']) ) ? $actions['OPEN'] : array();;
		for( $i = 0, $total = sizeof($open_info); $i < $total; $i++ )
		{
			$current_file = str_replace('\\', '/', trim($open_info[$i]['attrs']['SRC']));
			$this->actions['open'][$current_file] = array();

			$edit_info = ( !empty($open_info[$i]['children']['EDIT']) ) ? $open_info[$i]['children']['EDIT'] : array();
			for($j = 0, $edit_total = sizeof($edit_info); $j < $edit_total; $j++)
			{
				$action_info = ( !empty($edit_info[$j]['children']) ) ? $edit_info[$j]['children'] : array();
				$this->actions['open'][$current_file]['edit'][$j]['find'] = $action_info['FIND'][0]['data'];

				$actions = ( !empty($action_info['ACTION']) ) ? $action_info['ACTION'] : array();
				for($k = 0, $action_total = sizeof($actions); $k < $action_total; $k++)
				{
					$this->actions['open'][$current_file]['edit'][$j]['action'][] = array(
						'line'	=> 0,
						'type'	=> str_replace(',', '-', str_replace(' ', '', $actions[$k]['attrs']['TYPE'])),
						'code'	=> $actions[$k]['data']
					);
				}

				$inline_info = ( !empty($action_info['INLINE-EDIT']) ) ? $action_info['INLINE-EDIT'] : array();
				for($k = 0, $inline_total = sizeof($inline_info); $k < $inline_total; $k++)
				{
					$inline_actions =  ( !empty($inline_info[$k]['children']) ) ? $inline_info[$k]['children'] : array();

					$this->actions['open'][$current_file]['edit'][$j]['in-line-edit'][$k]['in-line-find'] = $inline_actions['INLINE-FIND'][0]['data'];

					$actions = ( !empty($inline_actions['INLINE-ACTION']) ) ? $inline_actions['INLINE-ACTION'] : array();
					for($x = 0, $actions_total = sizeof($actions); $x < $actions_total; $x++)
					{
						$type = str_replace(',', '-', str_replace(' ', '', $actions[$x]['attrs']['TYPE']));
						$this->actions['open'][$current_file]['edit'][$j]['in-line-edit'][$k]['in-line-action'][] = array(
							'line'	=> 0,
							'type'	=> (( $type != 'increment' ) ? 'in-line-' : '') . $type ,
							'code'	=> $actions[$x]['data']
						);
					}
				}
			}
		}
	}

	/**
	* Check the file is an install file. Return false, if it isn't
	*/
	function verify()
	{
		if(empty($this->data))
		{
			$this->_parse();
		}

		if(isset($this->data[0]['name']) && $this->data[0]['name'] == 'MOD')
		{
			return true;
		}
		return false;
	}
}

?>