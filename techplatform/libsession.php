<?php
/**
 * libsession
 * 
 * Faciliates session management
 * 
 * @package techplatform
 */
 
/**
 * Static class for session management
 * @package techplatform
 */
class APISession
{
	/** 
	 * Starts session support and other stuff
	 */
	static function start()
	{
		session_start();
		ob_start();
	}
	
	/**
	 * Sets a APIUser as this session's logged user
	 * @param APIUser $user user class
	 * @return bool succcess
	 */
	static function loginUser(APIUser $user)
	{
		$_SESSION['user'] = $user;
		$_SESSION['logged'] = true;
		return (bool)$_SESSION['logged'];
	}
	/**
	 * Logs current logged user out
	 */
	static function logoutUser()
	{
		try
		{
			$_SESSION['user']->logout();			// invalidate the class in case references existed
		} catch (Exception $e) {}
		unset($_SESSION['user']);				// and get rid of our reference
		$_SESSION['logged'] = false;
	}
	/**
	 * Checks whether an user is logged in
	 * @return bool is logged
	 */
	static function isLogged()
	{
		return (@$_SESSION['logged']==true);
	}
	/**
	 * Returns user currently logged in
	 * @return APIUser user currently logged in or null if no logged in
	 */
	static function getLogged()
	{
		if (!APISession::isLogged()) return null;
		return $_SESSION['user'];
	}
}
?>
