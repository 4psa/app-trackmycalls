<?php
/**
 * 4PSA VoipNow Plug-in: Call Events
*
* File contains all the functiones used to capture phone calls
*
* @version 1.0.0
* @license released under GNU General Public License
* @copyright (c) 2012 4PSA. (www.4psa.com). All rights reserved.
* @link http://wiki.4psa.com
*
*/


/**
 * Check's the errno no field for any error. If error exists, the script ends.
 */
function checkMysqlError() {
	global $db;

	if ( $db->errno ) {
		echo $db->error ;
		exit();
	}

	return;
}

/**
 * Inserts a note in the database.
 * 
 * @param array $contact An associative array (returned by getContactByPhone()) which contains the contact details.
 * 
 * @return boolean true if successful
 */
function insertNote($contact) {
	global $db;
	
	$date = date('H:i:s d M Y');
	$noteText = $db->real_escape_string("Client {$contact['firstName']} {$contact['lastName']} with phone # '{$_POST['CalledNumber']}' has been called by {$_POST['CallerIDName']} with ID '{$_POST['CallerIDNum']}'. Time: $date ");
	
	$insertQuery = <<<query
INSERT INTO `note` (customerId, notes)
VALUES ('{$db->real_escape_string($contact['id'])}', '$noteText');
query;
	
	$db->query($insertQuery, MYSQLI_STORE_RESULT);
	checkMysqlError();
	
	return true;
}

/**
 * Returns the full name of the client specified by phone #.
 * 
 * @param string $phone The phone number of a client.
 * 
 * @return mixed null if client does not exist in the database or an associative array with the contact's details
 */
function getContactByPhone($phone) {
	global $db;
	
	$selectQuery = <<<query
SELECT * FROM `contact` WHERE `phone` = '{$db->real_escape_string($phone)}';
query;
	
	$result = $db->query($selectQuery, MYSQLI_STORE_RESULT);
	checkMysqlError();
	
	if (!($result instanceof mysqli_result)) {
		error_log('SQL query failed in function '.__FUNCTION__.'. Could not retrieve contact with phone number '.$phone.'. The note couldn\'t be added.');
		return null;
	}
	
	$result = $result->fetch_assoc();
	if (!$result) {
		error_log("Contact with phone number $phone  not found in known contacts");
		return null;
	}
	return $result;
}