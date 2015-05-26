<?php
/**
 * 4PSA VoipNow Plug-in: Call Events
 *
 * This script will be requested by VoipNow server which will pass POST data.
 *
 * @version 1.0.0
 * @license released under GNU General Public License
 * @copyright (c) 2012 4PSA. (www.4psa.com). All rights reserved.
 * @link http://wiki.4psa.com
 *
 */

//the VoipNow interface should call this script with POST data
if ( empty($_POST) ) {
	error_log("No event received from POST");
	exit();
}

require_once 'plib/dbConnect.php';
require_once 'plib/functions.php';

//gets the configuration variables
$config = parse_ini_file('config/config.conf');
$db = getMysqliDB();
$contact = getContactByPhone($_POST['CalledNumber']);

//non-existant client, not interesting
if ( $contact === null ) {
	exit();
}

if ($_POST['CallStatus'] == 'ANSWER') {
	insertNote($contact);
}
