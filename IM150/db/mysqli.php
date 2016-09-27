<?php
/***************************************************************************
 *                                 mysqli.php
 *                            -------------------
 *   begin                : Saturday, Feb 13, 2001
 *   copyright            : (C) 2001 The phpBB Group
 *   email                : support@phpbb.com
 *
 *   $Id: mysqli.php,v 1.8 2005/10/31 03:18:41 jelly_doughnut Exp $
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

if(!defined("SQL_LAYER"))
{

define("SQL_LAYER","mysqli");

class sql_db
{

	var $db_connect_id;
	var $query_result;
	var $row = array();
	var $rowset = array();
	var $num_queries = 0;
	var $in_transaction = 0;
	var $sql_time = 0;

	//
	// Constructor
	//
	function sql_db($sqlserver, $sqluser, $sqlpassword, $database, $persistency = true)
	{
		$mtime = microtime();
		$mtime = explode(" ",$mtime);
		$mtime = $mtime[1] + $mtime[0];
		$starttime = $mtime;

		$this->persistency = $persistency;
		$this->user = $sqluser;
		$this->password = $sqlpassword;
		$this->server = $sqlserver;
		$this->dbname = $database;

		$this->db_connect_id = ($this->persistency) ? mysqli_pconnect($this->server, $this->user, $this->password) : mysqli_connect($this->server, $this->user, $this->password);

		if( $this->db_connect_id )
		{
			if( $database != "" )
			{
				$this->dbname = $database;
				$dbselect = mysqli_select_db($this->db_connect_id, $this->dbname);

				if( !$dbselect )
				{
					mysqli_close($this->db_connect_id);
					$this->db_connect_id = $dbselect;
				}
			}

			$mtime = microtime();
			$mtime = explode(" ",$mtime);
			$mtime = $mtime[1] + $mtime[0];
			$endtime = $mtime;

			$this->sql_time += $endtime - $starttime;

			return $this->db_connect_id;
		}
		else
		{
			$mtime = microtime();
			$mtime = explode(" ",$mtime);
			$mtime = $mtime[1] + $mtime[0];
			$endtime = $mtime;

			$this->sql_time += $endtime - $starttime;

			return false;
		}
	}

	//
	// Other base methods
	//
	function sql_close()
	{
		$mtime = microtime();
		$mtime = explode(" ",$mtime);
		$mtime = $mtime[1] + $mtime[0];
		$starttime = $mtime;

		if( $this->db_connect_id )
		{
			//
			// Commit any remaining transactions
			//
			if( $this->in_transaction )
			{
				mysqli_query($this->db_connect_id, "COMMIT");
			}

			$mtime = microtime();
			$mtime = explode(" ",$mtime);
			$mtime = $mtime[1] + $mtime[0];
			$endtime = $mtime;

			$this->sql_time += $endtime - $starttime;

			return mysqli_close($this->db_connect_id);
		}
		else
		{
			$mtime = microtime();
			$mtime = explode(" ",$mtime);
			$mtime = $mtime[1] + $mtime[0];
			$endtime = $mtime;

			$this->sql_time += $endtime - $starttime;

			return false;
		}
	}

	//
	// Base query method
	//
	function sql_query($query = "", $transaction = FALSE)
	{
		$mtime = microtime();
		$mtime = explode(" ",$mtime);
		$mtime = $mtime[1] + $mtime[0];
		$starttime = $mtime;

		//
		// Remove any pre-existing queries
		//
		unset($this->query_result);

		if( $query != "" )
		{
			$this->num_queries++;
			if( $transaction == BEGIN_TRANSACTION && !$this->in_transaction )
			{
				$result = mysqli_query($this->db_connect_id, "BEGIN");
				if(!$result)
				{

			$mtime = microtime();
			$mtime = explode(" ",$mtime);
			$mtime = $mtime[1] + $mtime[0];
			$endtime = $mtime;
		
			$this->sql_time += $endtime - $starttime;
			
					return false;
				}
				$this->in_transaction = TRUE;
			}

			$this->query_result = mysqli_query($this->db_connect_id, $query);
		}
		else
		{
			if( $transaction == END_TRANSACTION && $this->in_transaction )
			{
				$result = mysqli_query($this->db_connect_id, "COMMIT");
			}
		}

		if( $this->query_result )
		{
			unset($this->row[ (string) $this->query_result]);
			unset($this->rowset[ (string) $this->query_result]);

			if( $transaction == END_TRANSACTION && $this->in_transaction )
			{
				$this->in_transaction = FALSE;

				if ( !mysqli_query($this->db_connect_id, "COMMIT") )
				{
					mysqli_query($this->db_connect_id, "ROLLBACK");

			$mtime = microtime();
			$mtime = explode(" ",$mtime);
			$mtime = $mtime[1] + $mtime[0];
			$endtime = $mtime;
		
			$this->sql_time += $endtime - $starttime;
			
					return false;
				}
			}

			$mtime = microtime();
			$mtime = explode(" ",$mtime);
			$mtime = $mtime[1] + $mtime[0];
			$endtime = $mtime;

			$this->sql_time += $endtime - $starttime;

			return $this->query_result;
		}
		else
		{
			if( $this->in_transaction )
			{
				mysqli_query($this->db_connect_id, "ROLLBACK");
				$this->in_transaction = FALSE;
			}

			$mtime = microtime();
			$mtime = explode(" ",$mtime);
			$mtime = $mtime[1] + $mtime[0];
			$endtime = $mtime;

			$this->sql_time += $endtime - $starttime;

			return false;
		}
	}

	//
	// Other query methods
	//
	function sql_numrows($query_id = 0)
	{
		$mtime = microtime();
		$mtime = explode(" ",$mtime);
		$mtime = $mtime[1] + $mtime[0];
		$starttime = $mtime;

		if( !$query_id )
		{
			$query_id = $this->query_result;
		}

		$mtime = microtime();
		$mtime = explode(" ",$mtime);
		$mtime = $mtime[1] + $mtime[0];
		$endtime = $mtime;

		$this->sql_time += $endtime - $starttime;

		return ( $query_id ) ? mysqli_num_rows($query_id) : false;
	}

	function sql_affectedrows()
	{
		$mtime = microtime();
		$mtime = explode(" ",$mtime);
		$mtime = $mtime[1] + $mtime[0];
		$starttime = $mtime;

		$mtime = microtime();
		$mtime = explode(" ",$mtime);
		$mtime = $mtime[1] + $mtime[0];
		$endtime = $mtime;
		
		$this->sql_time += $endtime - $starttime;

		return ( $this->db_connect_id ) ? mysqli_affected_rows($this->db_connect_id) : false;
	}

	function sql_numfields($query_id = 0)
	{
		$mtime = microtime();
		$mtime = explode(" ",$mtime);
		$mtime = $mtime[1] + $mtime[0];
		$starttime = $mtime;

		if( !$query_id )
		{
			$query_id = $this->query_result;
		}

		$mtime = microtime();
		$mtime = explode(" ",$mtime);
		$mtime = $mtime[1] + $mtime[0];
		$endtime = $mtime;

		$this->sql_time += $endtime - $starttime;

		return ( $query_id ) ? mysqli_num_fields($query_id) : false;
	}

	function sql_fieldname($offset, $query_id = 0)
	{
		$mtime = microtime();
		$mtime = explode(" ",$mtime);
		$mtime = $mtime[1] + $mtime[0];
		$starttime = $mtime;

		if( !$query_id )
		{
			$query_id = $this->query_result;
		}

		$mtime = microtime();
		$mtime = explode(" ",$mtime);
		$mtime = $mtime[1] + $mtime[0];
		$endtime = $mtime;

		$this->sql_time += $endtime - $starttime;

		return ( $query_id ) ? mysqli_field_name($query_id, $offset) : false;
	}

	function sql_fieldtype($offset, $query_id = 0)
	{
		$mtime = microtime();
		$mtime = explode(" ",$mtime);
		$mtime = $mtime[1] + $mtime[0];
		$starttime = $mtime;

		if( !$query_id )
		{
			$query_id = $this->query_result;
		}

		$mtime = microtime();
		$mtime = explode(" ",$mtime);
		$mtime = $mtime[1] + $mtime[0];
		$endtime = $mtime;

		$this->sql_time += $endtime - $starttime;

		return ( $query_id ) ? mysqli_fetch_field_direct($query_id, $offset) : false;
	}

	function sql_fetchrow($query_id = 0)
	{
		$mtime = microtime();
		$mtime = explode(" ",$mtime);
		$mtime = $mtime[1] + $mtime[0];
		$starttime = $mtime;

		if( !$query_id )
		{
			$query_id = $this->query_result;
		}

		if( $query_id )
		{
			$this->row[ (string) $query_id] = mysqli_fetch_array($query_id, MYSQLI_ASSOC);

			$mtime = microtime();
			$mtime = explode(" ",$mtime);
			$mtime = $mtime[1] + $mtime[0];
			$endtime = $mtime;

			$this->sql_time += $endtime - $starttime;

			return $this->row[ (string) $query_id];
		}
		else
		{
			$mtime = microtime();
			$mtime = explode(" ",$mtime);
			$mtime = $mtime[1] + $mtime[0];
			$endtime = $mtime;

			$this->sql_time += $endtime - $starttime;

			return false;
		}
	}

	function sql_fetchrowset($query_id = 0)
	{
		$mtime = microtime();
		$mtime = explode(" ",$mtime);
		$mtime = $mtime[1] + $mtime[0];
		$starttime = $mtime;

		if( !$query_id )
		{
			$query_id = $this->query_result;
		}

		if( $query_id )
		{
			unset($this->rowset[ (string) $query_id]);
			unset($this->row[ (string) $query_id]);

			while($this->rowset[ (string) $query_id] = mysqli_fetch_array($query_id, MYSQLI_ASSOC))
			{
				$result[] = $this->rowset[ (string) $query_id];
			}

			$mtime = microtime();
			$mtime = explode(" ",$mtime);
			$mtime = $mtime[1] + $mtime[0];
			$endtime = $mtime;

			$this->sql_time += $endtime - $starttime;

			return $result;
		}
		else
		{
			$mtime = microtime();
			$mtime = explode(" ",$mtime);
			$mtime = $mtime[1] + $mtime[0];
			$endtime = $mtime;

			$this->sql_time += $endtime - $starttime;

			return false;
		}
	}

	function sql_fetchfield($field, $rownum = -1, $query_id = 0)
	{
		$mtime = microtime();
		$mtime = explode(" ",$mtime);
		$mtime = $mtime[1] + $mtime[0];
		$starttime = $mtime;

		if( !$query_id )
		{
			$query_id = $this->query_result;
		}

		if( $query_id )
		{
			if( $rownum > -1 )
			{
				//$result = mysqli_result($query_id, $rownum, $field);
				$result = @mysql_result($query_id, $rownum, $field);
			}
			else
			{
				if( empty($this->row[$query_id]) && empty($this->rowset[$query_id]) )
				{
					if( $this->sql_fetchrow() )
					{
						$result = $this->row[$query_id][$field];
					}
				}
				else
				{
					if( $this->rowset[$query_id] )
					{
						$result = $this->rowset[$query_id][0][$field];
					}
					else if( $this->row[$query_id] )
					{
						$result = $this->row[$query_id][$field];
					}
				}
			}

			$mtime = microtime();
			$mtime = explode(" ",$mtime);
			$mtime = $mtime[1] + $mtime[0];
			$endtime = $mtime;

			$this->sql_time += $endtime - $starttime;

			return $result;
		}
		else
		{
			$mtime = microtime();
			$mtime = explode(" ",$mtime);
			$mtime = $mtime[1] + $mtime[0];
			$endtime = $mtime;

			$this->sql_time += $endtime - $starttime;

			return false;
		}
	}

	function sql_rowseek($rownum, $query_id = 0)
	{
		$mtime = microtime();
		$mtime = explode(" ",$mtime);
		$mtime = $mtime[1] + $mtime[0];
		$starttime = $mtime;

		if( !$query_id )
		{
			$query_id = $this->query_result;
		}

		$mtime = microtime();
		$mtime = explode(" ",$mtime);
		$mtime = $mtime[1] + $mtime[0];
		$endtime = $mtime;

		$this->sql_time += $endtime - $starttime;

		return ( $query_id ) ? mysqli_data_seek($query_id, $rownum) : false;
	}

	function sql_nextid()
	{
		$mtime = microtime();
		$mtime = explode(" ",$mtime);
		$mtime = $mtime[1] + $mtime[0];
		$starttime = $mtime;

		$mtime = microtime();
		$mtime = explode(" ",$mtime);
		$mtime = $mtime[1] + $mtime[0];
		$endtime = $mtime;
		
		$this->sql_time += $endtime - $starttime;

		return ( $this->db_connect_id ) ? mysqli_insert_id($this->db_connect_id) : false;
	}

	function sql_freeresult($query_id = 0)
	{
		$mtime = microtime();
		$mtime = explode(" ",$mtime);
		$mtime = $mtime[1] + $mtime[0];
		$starttime = $mtime;

		if( !$query_id )
		{
			$query_id = $this->query_result;
		}

		if ( $query_id )
		{
			unset($this->row[ (string) $query_id]);
			unset($this->rowset[ (string) $query_id]);

			mysqli_free_result($query_id);
			
			$mtime = microtime();
			$mtime = explode(" ",$mtime);
			$mtime = $mtime[1] + $mtime[0];
			$endtime = $mtime;

			$this->sql_time += $endtime - $starttime;

			return true;
		}
		else
		{
			$mtime = microtime();
			$mtime = explode(" ",$mtime);
			$mtime = $mtime[1] + $mtime[0];
			$endtime = $mtime;

			$this->sql_time += $endtime - $starttime;

			return false;
		}
	}

	function sql_error()
	{
		$mtime = microtime();
		$mtime = explode(" ",$mtime);
		$mtime = $mtime[1] + $mtime[0];
		$starttime = $mtime;

		$result['message'] = @mysqli_error((int)$this->db_connect_id);
		$result['code'] = @mysqli_errno((int)$this->db_connect_id);

		$mtime = microtime();
		$mtime = explode(" ",$mtime);
		$mtime = $mtime[1] + $mtime[0];
		$endtime = $mtime;

		$this->sql_time += $endtime - $starttime;

		return $result;
	}

} // class sql_db

} // if ... define

?>