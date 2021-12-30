<?php
	/**
	 * 	libdbapi
	 * 	
	 *  Database API
	 * 
	 * @package techplatform
	 *  */
	 
/** 
 * Database interface class
 * @package techplatform
 * @subpackage libdbapi
 */	
	 
class APIDatabase extends LastErrorImplementation
{
	/**
	 * amount of queries to the database made though this class
	 * @var int
	 */
	protected $queries = 0;
	/**
	 * Current database name
	 * @var string
	 */
	public $current_db = '';
	/**
	 * returns significant queries made though this class
	 * NOT-LEAN
	 * @return int Amount of queries
	 */
	function getQueryCount()
	{
		return $this->queries;
	}
	/**
	 * Checks whether given-ID record exists
	 * @param string $table nazwa tabeli
	 * @param int $id ID rekordu
	 */
	function exists($table, $id)
	{
		$this->queries++;		
		$res = $this->query("SELECT count(id) FROM $table WHERE id=%s",array($id));
		return (getRows($res) != 0);
	}
	/**
	 * Used to translate string-values given by user to internal SQLs, also prevents SQL-injection
	 */
	private function translatef($val)
	{
		// TODO: Possible unsecurity there, fix it
		$specials = array(null => 'NULL');
		if (array_key_exists($val, $specials))
		{
			return $specials[$val];
		} else
		{
			return '"'.mysql_real_escape_string($val).'"';
		}
	}
	/**
	 * Gets fields of a table
	 * @param string $table name of the table
	 * @return array|bool contains field names or false if failed
	 */
	function getFields($table)
	{
		$res = $this->query("SHOW COLUMNS FROM $table");
		$this->queries++;
		if (!$res)
		{
			$this->setLastError(mysql_error($this->dbres));
			return false;
		}
		$temp = array();
		while($row = $this->toArray($res))
		{
			$temp[] = $row['Field'];
		}
		return $temp;
	}
	/** 
	 * Controls database read-onliness
	 * If set to true, database will not be modified, but write functions will reply success
	 * query() call is not shielded
	 * @param bool $readonly read-onliness
	 */
	function setReadonly($readonly)
	{
		$this->readonly = $readonly;
	}
	/**
	 * Controls database debuginess
	 * If set to true, database will echo all queries prior to sending them to database
	 * NOT-LEAN
	 * @param bool $debug debuginess
	 */
	function setDebug($debug)
	{
		$this->debug = $debug;
	}
	/**
	 * Constructor. Just saves given data
	 * @param string $host Host address
	 * @param string $user User name
	 * @param string $pass password
	 */
	function __construct($host, $user, $pass)
	{
		$this->host = $host;
		$this->user = $user;
		$this->pass = $pass;
		$this->readonly = false;
		$this->debug = false;
	}
	/**
	 * Connects with the database
	 * @return bool success
	 */
	function connect()
	{
		$this->dbres = mysql_connect($this->host, $this->user, $this->pass, true);
		$this->ready = (bool)$this->dbres;
		$this->setLastError(($this->ready ? '' : mysql_error()));
		
		mysql_query("SET NAMES 'utf8'", $this->dbres);
		mysql_query("SET CHARACTER SET 'utf8'",$this->dbres);
		mysql_query("SET COLLATION utf8_unicode_ci",$this->dbres);
		
		mysql_query('SET character_set_client = utf8;',$this->dbres);
		mysql_query('SET character_set_results = utf8;',$this->dbres);
		mysql_query('SET character_set_connection = utf8;',$this->dbres);
		mysql_query('SET character_set_database=utf8;',$this->dbres);
		mysql_query('SET character_set_server=utf8;',$this->dbres);
				
		return $this->ready; 		
	}
	/** 
	 * Gets row counts from query result
	 * @param resource $res Query result
	 * @return int Row count
	 */
	function getRows($res)
	{
		return mysql_num_rows($res);
	}
	/**
	 * Returns last inserted ID
	 * @return int ID
	 */
	function lastInsertId()
	{
		return mysql_insert_id($this->dbres);
	}
	/** 
	 * Updates given table
	 * @param string $table table name
	 * @param array $array hasharray field_name => field_value (just pure data)
	 * @param string $where SQL condition for update. With quotes and escapes
	 * @return bool success
	 */
	function updateArray($table, $array, $where)
	{
		if ($this->readonly) return true;
	    $vals = array();
		    $q = array();
			foreach ($array as $k=>&$v)
			{
				$array[$k] = $this->translatef($v);
				$q[] = $k.'='.$v.'';
			}
	    $sql = "UPDATE $table SET ".implode(',', $q)." WHERE $where";
	    if ($this->debug) echo($sql);
		$this->queries++;
	    
	    if (!mysql_query($sql,$this->dbres))
	    {
	    	$this->setLastError(mysql_error());
	    	return false;
	    } else return true;
	}
	/**
	 * Updates given table by row's id
	 * @param string $table table name
	 * @param array $array hash table field_name => field_value (just pure data)
	 * @param int $id record ID
	 * @return bool success
	 */
	function updateArrayID($table, $array, $id)
	{
		return $this->updateArray($table, $array, 'id="'.mysql_real_escape_string($id).'"');
	}
	/** 
	 * Inserts new row into a table
	 * @param string $table table name
	 * @param array $array hashtable field_name => field_value (just pure data)
	 * @return bool success
	 */
	function insertArray($table, $array)
	{
		if ($this->readonly) return true;	
	    $keys = array_keys($array);
	    $values = array_values($array);
		$vals = array();
		foreach ($values as $v)
		{
			$vals[] = $this->translatef($v);
		}	   
		$values = $vals;
	    $sql = 'INSERT INTO ' . $table. '(' . implode(',', $keys) . ') VALUES (' . implode(',', $values) . ')';
	    
	    if ($this->debug) echo($sql);
		$this->queries++;    
	    if (!mysql_query($sql,$this->dbres))
	    {
	    	$this->setLastError(mysql_error());
	    	return false;
	    } else return true;
	}
	/**
	 * Grabs next row from a query result, or false when no more rows
	 * @param resource $query_result query result
	 * @return array|bool query row or false if no more 
	 */
	function toArray($query_result)
	{
		return mysql_fetch_array($query_result, MYSQL_ASSOC);
	}
	/** 
	 * Executes a query
	 * @param string $query a query with %s set in places where data with quotes and escapes is to be subsituted
	 * @param array $params pure data ordered in order %s will be substituted
	 * @return bool success
	 */
	function query($query, $params=array())
	{
		foreach ($params as $param)
		{
			$pos = strpos($query, '%s');
			$query = substr_replace($query, $this->translatef($param), $pos, 2);
		}
		if ($this->debug) echo($query);
		$res = mysql_query($query, $this->dbres);
		$this->queries++;
		if (!$res) 
		{
			$this->setLastError(mysql_error($this->dbres));
			return false;
		} else return $res;
	}
	/**
	 * Changes database
	 * @param string $dbanem database name
	 * @return bool success
	 */
	function selectDatabase($dbname)
	{
		$res = mysql_select_db($dbname,$this->dbres);
		if (!$res)
		{
			$this->setLastError(mysql_error());
			return false;
		} else 
		{
			$this->current_db = $dbname;
			return true;
		}
	}
}



/**
 * Base class for data access. Abstracts database rows.
 * Access to fields available. Fields are created as properties.
 * Optimizes writebacks.
 * 
 * @package techplatform
 * @subpackage libdbapi
 */
class APIDBObject extends LastErrorImplementation
{
	/**
	 * Current database link
	 * @var resource
	 */
	public $__db = null;
	/**
	 * Stores fields applicable to the table
	 * @var array
	 */
	protected $__fields = array();
	/**
	 * Stores row data
	 * @var array
	 */
	protected $__data = array();
	/** 
	 * Stores information of dirtiness of the fields (whether were they written).
	 * For optimization of writebacks
	 * @var array
	 */
	protected $__dirty = array();
	/**
	 * Stores current table name
	 * @var string
	 */
	protected $__table = '';

	function __get($name)
	{
		return $this->__data[$name];
	}
	function __set($name, $value)
	{
		if (in_array($name, $this->__fields))
		{
			$this->__dirty[$name] = true;
			$this->__data[$name] = $value;
		}
	}	
	/**
	 * Generic constructor. To be always called by the child.
	 * The child is expected to supply information on table layout with protected $__fields variable and table name with $__table.
	 * That's because of pure performance concern(to avoid a SHOW COLUMNS query).
	 * If it cannot, it should pass the table name to the constructor
	 * @param resource $dbh database link
	 * @param string $table table name
	 */
	function __construct($dbh, $table=null)
	{
		$this->__db = $dbh;
		if (!($table===null))
		{
			$this->__fields = $this->__db->getFields($table);
			$this->__table = $table;
		} 
	}
	/**
	 * Creates a given field and loads it. 
	 * Children are encouraged to provide own __create() methods with parameters
	 * that will describe fields.
	 * @param array $data data. field_name => field_value (just pure data)
	 * @return bool true if success, false if failure
	 */
	function __create($data)
	{
		$this->__db->insertArray($this->__table, $data);
		return $this->__load($this->__db->lastInsertId());
	}
	/**
	 * Stores the current row in the database
	 * @return bool success
	 */
	function __store()
	{
		$wbq = array();
		foreach ($this->__fields as $fieldname)	if ($this->__dirty[$fieldname]) $wbq[$fieldname] = $this->__data[$fieldname];
		if (!$this->__db->updateArrayID($this->__table, $wbq, $this->__data['id']))
		{ 
			$this->copyLastError($this->__db);
			return false;
		}
		foreach ($this->__dirty as $dk=>$dv) $this->__dirty[$dk] = false;
		return true;
	}
	/**
	 * Checks a rows existence by its field
	 * @param string $field field name
	 * @param string $value value name (will be reparsed using translatef())
	 * @return bool true if field exist, false if it doesn't
	 */
	function __checkBy($field, $value)
	{
		$res = $this->__db->query("SELECT COUNT(*) FROM $this->__table WHERE $field=%s",array($value));
		$fields = $this->__db->toArray($res);
		return ($fields['COUNT(*)'] <> 0);
	}
	/**
	 * Loads a row by its property
	 * @param string $field field name
	 * @param string $value value name (will be reparsed using translatef())
	 * @return bool whether success has occurred
	 */
	function __loadBy($field, $value)
	{
		$res = $this->__db->query("SELECT * FROM $this->__table WHERE $field=%s",array($value));
		if (!$res)
		{
			$this->copyLastError($this->__db);
			return false;
		}
		if ($this->__db->getRows($res)==0)
		{
			$this->setLastError("APIDBObject: __load(): could not find given record");
			return false;
		}
		$row = $this->__db->toArray($res);
		foreach ($this->__fields as $field)
		{
			$this->__data[$field] = $row[$field];
			$this->__dirty[$field] = false;
		}
		return true;			
	}
	/**
	 * Loads a row by it's id
	 * @param int $id row ID
	 * @return bool success
	 */
	function __load($id)
	{
		return $this->__loadBy('id',$id);
	}
	/**
	 * Removes a row as it is loaded. Destroys class properties.
	 * @return bool success
	 */
	function __delete()
	{
		return $this->__db->query("DELETE FROM $this->__table WHERE id=%s",array($this->id));
	}
	/**
	 * Returns all rows in the table
	 * @return array all rows in the table, no order guaranteed
	 */
	function getRows()
	{
		return $this->__fields;
	}
	/**
	 * Loads only rows specified in command. Use with care.
	 * @param string $rowname row name
	 * @param string $rowvalue desired row value, will be translatef()ed
	 * @param array $rowstoload rows to load
	 */
	function __sloadBy($rowname, $rowvalue, $rowstoload)
	{
		$rtl = array();
		foreach($rowstoload as $rowtoload) $rtl[] = '`'.$rowtoload.'`';
		$rowquery = implode(',',$rtl);
		$res = $this->__db->query("SELECT $rowquery FROM $this->__table WHERE $rowname=%s",array($rowvalue));
		if ($this->__db->getRows($res)==0)
		{
			$this->setLastError("APIDBObject: __load(): could not find given record");
			return false;
		}		
		$row = $this->__db->toArray($res);
		foreach ($this->__fields as $field)
		{
			$this->__data[$field] = $row[$field];
			$this->__dirty[$field] = false;
		}
		return true;			
	}
	/**
	 * Loads only selected rows in command. Use with care
	 * @param int $id row ID
	 * @param array $rowstoload rows to load
	 */
	function __sload($id, $rowstoload)
	{
		$retval = $this->__sloadBy('id',$id,$rowstoload);
		$this->__data['id'] = $id; $this->__dirty['id'] = false;
		return $retval;
	}
	/**
	 * Just initializes the record, does not load anything from the db
	 * @param int $id row ID
	 */
	function __declare($id)
	{
		$this->__data['id'] = $id;
	}
	
}
?>
