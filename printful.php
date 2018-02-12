<?php 
class Database {
	private $_connection;
	private static $_instance; //The single instance
	private $_host = "localhost";
	private $_username = "root";
	private $_password = "";
	private $_database = "printful";
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
}
	class person {
		var $name;		
		public $height;		
		protected $social_insurance;
		private $pinn_number;
 
		function __construct($persons_name) {		
			$this->name = $persons_name;		
		}		
 
		function set_name($new_name) {   	
			$this->name = $new_name;
		}	
 
		function get_name() {
			return $this->name;
		}	
		private function get_pinn_number(){
			return
			$this->pinn_number;  
		}  
	}
	class employee extends person 
{
	function __construct($employee_name){
		$this->set_name($employee_name);
	}
}
class foo_mysqli extends mysqli{
	public $conn;
    public function __construct($host, $user, $pass, $db) {
        parent::__construct($host, $user, $pass, $db);

        if (mysqli_connect_error()) {
            die('Connect Error (' . mysqli_connect_errno() . ') '
                    . mysqli_connect_error());
        }$conn=$db;
    }
	
}

$db = new foo_mysqli('localhost', 'root', '', 'printful');


/*
class test extends foo_mysqli{

    var $result = $conn->query("select id, testname from tests_list_table");

   // echo "<select name='id'>";

    while ($row = $result->fetch_assoc()) {

                  unset($testid, $testname);
                  $testid = $row['id'];
                  $testname = $row['testname']; 
                  echo '<option value="'.$id.'">'.$testname.'</option>';


}
*/


function thatfunk(){
	$conn = new mysqli('localhost', 'root', '', 'printful') 
or die ('Cannot connect to db');

    $result = $conn->query("select id, testname from tests_list_table");

   // echo "<select name='id'>";

    while ($row = $result->fetch_assoc()) {

                  unset($testid, $testname);
                  $testid = $row['id'];
                  $testname = $row['testname']; 
                  echo '<option value="'.$id.'">'.$testname.'</option>';
                 
}

//echo "</select>";
  
}
?>
