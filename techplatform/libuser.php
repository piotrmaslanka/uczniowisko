<?php
	/**
	 * libuser
	 * 
	 * Library for user handling
	 * 
	 * @package techplatform
	 */
	 
/**
 * Class representing a single user/service
 * @package techplatform
 */	 
class APIUser extends LastErrorImplementation
{
	/**
	 * Returns user ID
	 * @return int User ID
	 */
	function getID()
	{
		return $this->id;
	}
	/**
	 * Returns username
	 * @return string Username
	 */
	function getUsername()
	{
		return $this->username;
	}
	/**
	 * Returns user password
	 * @return string User password in its SHA1 form
	 */
	function getPasswd()
	{
		return $this->password;
	}
	/**
	 * Returns user token
	 * @return string User token
	 */
	function getToken()
	{
		return $this->token;
	}	
	/**
	 * Stores the user and prepares the class for destruction
	 */
	function logout()
	{
		$this->storeRegistry();
		unset($this->username); unset($this->password); unset($this->id); unset($this->type);
	}
	/**
	 * Forcibly initiates the class with user/service id
	 * @param int $id user/service id
	 * @return bool success
	 */
	function createForceId($id)						// forces creation by ID
	{
		global $tpInternal;
		$res = $tpInternal['db']->query("SELECT username, token, type FROM tpusers WHERE (id=%s)", array($id));
		if (!$res) 
		{
			$this->copyLastError($tpInternal['db']);
			return false;
		}
		if ($tpInternal['db']->getRows($res)==0)
		{
			$this->lasterror = 'Wrong user';
			return false;
		}
		$row = $tpInternal['db']->toArray($res);
		$this->username = $row['username'];
		$this->token = $row['token'];
		$this->id = $id;
		$this->type = (int)$row['type'];
		return true;				
	}
	/**
	 * Removes current user from the database
	 * @return bool success
	 */
	function deleteUser()
	{
		global $tpInternal;
		//TODO: error-proof fixes
		$tpInternal['db']->query('DELETE FROM tpusers WHERE id=%s',array($this->id));
		$this->id = null;
		return true;
	}
	/**
	 * Forcibly initiates the class with user/service login
	 * @param string $username user/service login
	 * @return bool success
	 */
	function createForce($username)					// forces creation by username
	{
		global $tpInternal;
		$res = $tpInternal['db']->query("SELECT id, token, type FROM tpusers WHERE (username=%s)", array($username));
		if (!$res) 
		{
			$this->copyLastError($tpInternal['db']);
			return false;
		}
		if ($tpInternal['db']->getRows($res)==0)
		{
			$this->lasterror = 'Wrong user';
			return false;
		}
		$row = $tpInternal['db']->toArray($res);
		$this->username = $username;
		$this->token = $row['token'];
		$this->id = $row['id'];
		$this->type = (int)$row['type'];
		return true;		
	}
	/**
	 * Initiates the class with user/service based on authentication
	 * @param string $username user/service login
	 * @param string $password user/service password
	 * @return bool success
	 */
	function createByLogin($username, $password)			// creates by authentication
	{
		global $tpInternal;	
		$res = $tpInternal['db']->query("SELECT id, token, type FROM tpusers WHERE (username=%s) AND (password=SHA1(%s))", array($username, $password));
		if (!$res) 
		{
			$this->copyLastError($tpInternal['db']);
			return false;
		}
		if ($tpInternal['db']->getRows($res)==0)
		{
			$this->lasterror = 'Wrong user or password';
			return false;
		}
		$row = $tpInternal['db']->toArray($res);
		$this->username = $username;
		$this->token = $row['token'];
		$this->password = sha1($password);	/* passwd shouldn't remain on disk in plaintext
									longer that it is absolutely needed to prevent theft */ 
		$this->id = $row['id'];
		$this->type = (int)$row['type'];
		return true;
	}
	/**
	 * Writes back user/service registry to database
	 * @return bool success
	 */
	function storeRegistry()
	{
		if (empty($this->id))
		{
			$this->setLastError('Class does not contain a logged-in user');
			return false;
		}
		
		$reg = $this->registry;
		
		$licenses = serialize($reg['Licenses']);
		$privileges = serialize($reg['Privileges']);
		unset($reg['Licenses']);
		unset($reg['Privileges']);
		$registry = serialize($reg);
		
		global $tpInternal;
		if (!$tpInternal['db']->updateArray('tpusers',array('registry'=>$registry,
												       'licenses'=>$licenses,
													   'privileges'=>$privileges), 'id="'.$this->id.'"'))
		{
			$this->copyLastError($tpInternal['db']);
			return false;											   	
		}
		return true;
		
	}
	/**
	 * Loads user/service registry from database
	 * @return bool success
	 */
	function loadRegistry()
	{
		if (empty($this->id)) 
		{
			$this->setLastError('Class does not contain a logged-in user');
			return false;
		}
		global $tpInternal;
		
		$this->registry = array();
		$res = $tpInternal['db']->query("SELECT registry, privileges, licenses FROM tpusers WHERE id=%s", array($this->id));
		$row = $tpInternal['db']->toArray($res);
		$this->registry = unserialize($row['registry']);
		$this->registry['Privileges'] = unserialize($row['privileges']);
		$this->registry['Licenses'] = unserialize($row['licenses']);
		return true;
	}
	/**
	 * Changes user's password
	 * @param string $passwd New password
	 * @return bool If success
	 */
	function changePasswd($passwd)
	{
		global $tpInternal;
		if (!$tpInternal['db']->updateArrayID('tpusers', array('password'=>sha1($passwd)), $this->id))
		{
			$this->copyLastError($tpInternal['db']);
			return false;		
		}
		$this->password = sha1($passwd);
		return true;		
	}
}
?>