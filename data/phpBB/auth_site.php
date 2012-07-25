<?php
/**
* Sesquidistus website auth plug-in for phpBB3
*
* This is for authentication via the Sesquidistus user table
*
* @package login
* @version $Id$
*
*/

/**
* @ignore
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

require_once('functions.php');

/**
* Convert a row from our database to something phpBB understand
*
* @param array $row Associative array where key is the column name in my DB
* @return array An associative array containing the mandatory key for phpBB
*/
function user_to_phpBB_row($row) {
	$phpBBrow = array(
		'user_id' => $row['id'],
		'username' => $row['login'],
		'user_password' => $row['passwd'],
		'user_email' => $row['mail'],
		'user_type' => ($row['admin']) ? USER_FOUNDER : USER_NORMAL,
		'group_id' => ($row['admin']) ? 5 : 2,
	);
	return $phpBBrow;
}


/**
* Login function
*
* @param string $username
* @param string $password
* @param string $ip			IP address the login is taking place from. Used to
*							limit the number of login attempts per IP address.
* @param string $browser	The user agent used to login
* @param string $forwarded_for X_FORWARDED_FOR header sent with login request
* @return array				A associative array of the format
*							array(
*								'status' => status constant
*								'error_msg' => string
*								'user_row' => array
*							)
*/
function login_site($username, $password, $ip = '', $browser = '', $forwarded_for = '')
{
	global $db, $config;

	// do not allow empty password
	if (!$password)
	{
		return array(
			'status'	=> LOGIN_ERROR_PASSWORD,
			'error_msg'	=> 'NO_PASSWORD_SUPPLIED',
			'user_row'	=> array('user_id' => ANONYMOUS),
		);
	}

	if (!$username)
	{
		return array(
			'status'	=> LOGIN_ERROR_USERNAME,
			'error_msg'	=> 'LOGIN_ERROR_USERNAME',
			'user_row'	=> array('user_id' => ANONYMOUS),
		);
	}

	#$sql = 'SELECT user_id, username, user_password, user_passchg, user_pass_convert, user_email, user_type, user_login_attempts
	$sql = 'SELECT m.id, m.login, m.passwd, p.mail
		FROM membre m, profil p 
		WHERE m.id = p.id_membre
			AND login = "' . $db->sql_escape($username) . '"';
	$result = $db->sql_query($sql);
	$row = $db->sql_fetchrow($result);
	$db->sql_freeresult($result);

	if (!$row)
	{
		return array(
			'status'	=> LOGIN_ERROR_USERNAME,
			'error_msg'	=> 'LOGIN_ERROR_USERNAME',
			'user_row'	=> array('user_id' => ANONYMOUS),
		);
	}

	// Check password ...
	if (!site_check_hash($password, $row['passwd']))
	{
		// Give status about wrong password...
		return array(
			'status'		=> LOGIN_ERROR_PASSWORD,
			'error_msg'		=> 'LOGIN_ERROR_PASSWORD',
			'user_row'		=> $row,
		);
	}

	// Successful login... 
	$sql = 'SELECT user_id, username, user_password, user_passchg, user_email, user_type
		FROM ' . USERS_TABLE . "
		WHERE username = '" . $db->sql_escape($row['login']) . "'";
	$result = $db->sql_query($sql);
	$rowPhpBB = $db->sql_fetchrow($result);
	$db->sql_freeresult($result);
	// The user is already in the phpBB database
	if ($rowPhpBB) 
	{
		return array(
			'status'		=> LOGIN_SUCCESS,
			'error_msg'		=> false,
			'user_row'		=> user_to_phpBB_row($row),
		);
	}
	// First connection in the forum, we must add the user and create an empty profile
	return array(
		'status'    => LOGIN_SUCCESS_CREATE_PROFILE,
		'error_msg'   => false,
		'user_row'    => user_to_phpBB_row($row),
	);
}

/**
* Autologin function
*
* @return array containing the user row or empty if no auto login should take place
*/
function autologin_site()
{
	echo 'ok';
	return array();
}

?>
