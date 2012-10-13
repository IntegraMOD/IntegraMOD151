<?php
/**
 *
 * @package SQL Parser
 * @version $Id: sql_builder.php,v 1.3 2005/09/26 09:59:13 markus_petrux Exp $
 * @copyright (c) 2005 phpBB Group
 * @license http://opensource.org/licenses/gpl-license.php GNU General Public License
 *
 */


/**
 * SQL Builder Class
 *
 * This class is aimed to provide common services to all builder classes.
 */
class sql_builder
{
	/**
	 * A pointer to the main parser object.
	 *
	 * @access public
	 */
	var $parser;

	/**
	 * Common indentation string for some kind of generated statements.
	 *
	 * @access public
	 */
	var $indent = '    ';

	/**
	 * Constructor
	 */
	function sql_builder(&$parser)
	{
		$this->parser = &$parser;
	}

	/**
	 * Generate a safe SQL identifier.
	 *
	 * @see class sql_parser
	 *
	 * @access public
	 */
	function get_identifier($identifier, $suffix = '')
	{
		return $this->parser->get_identifier($identifier, $suffix);
	}
}

?>