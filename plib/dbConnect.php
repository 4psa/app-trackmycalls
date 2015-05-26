<?php
/**
 * 4PSA VoipNow Plug-in: Call Events
*
* File contains the function that retrieves a mysqli connection.
*
* @version 1.0.0
* @license released under GNU General Public License
* @copyright (c) 2012 4PSA. (www.4psa.com). All rights reserved.
* @link http://wiki.4psa.com
*
*/

/**
 * Gets a connection from the MySQLi database.
 * 
 * @return mysqli
 */
function getMysqliDB() {
	global $config;
	
	$db = new mysqli($config['db_host'], $config['db_username'], $config['db_password'],
			$config['db_databaseName'], $config['db_port']);
	
	if ( $db->errno ) {
		echo $db->error ;
		exit();
	}
	
	
	return $db;
}

