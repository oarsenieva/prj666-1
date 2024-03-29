<?php
/*
* Mysql database class - only one connection alowed
*/
class Database {
	private $_connection;
	private static $_instance; //The single instance
	private $_host = "HOST";
	private $_username = "USERNAME";
	private $_password = "PASSWORd";
	private $_database = "DATABASE";
	/*
	Get an instance of the Database
	@return Instance
	*/
	public static function getInstance() {
		if(!self::$_instance) { // If no instance then make one
			self::$_instance = new self();
		}
		return self::$_instance;
	}
	// Constructor
	private function __construct() {

		$sqlinfo = parse_ini_file("/secret/sql.ini");
		$this->_host = $sqlinfo['host'];
		$this->_username = $sqlinfo['username'];
		$this->_password = $sqlinfo['password'];
		$this->_database = $sqlinfo['database'];

		$this->_connection = new mysqli($this->_host, $this->_username, 
			$this->_password, $this->_database);
	
		// Error handling
		if(mysqli_connect_error()) {
			trigger_error("Failed to conencto to MySQL: " . mysql_connect_error(),
				 E_USER_ERROR);
		}
	}
	// Magic method clone is empty to prevent duplication of connection
	private function __clone() { }
	// Get mysqli connection
	public function getConnection() {
		return $this->_connection;
	}

	function __destruct() {
		$this->_connection ->close();
	}

	function createNewDatabase($dbName){
		$flag=true;
    		$conn = new mysqli($this->_host, $this->_username, $this->_password);
		// Check connection
		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		} 

		// Create database
		$sql = "CREATE DATABASE $dbName";
		if ($conn->query($sql) === TRUE) {
		    $flag=true;
		} else {
		    $flag=false;
		}

		$conn->close();
		return $flag;
	}
}
?>
