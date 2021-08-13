
<?php 

class connect_me
{
 protected $db_host = "localhost";
protected $db_name = "newsite"; 
protected $db_user = "root";  
protected $db_pass = ""; 
protected $db_optn = null;
public $conn = null;
private static $ErrorArray;
public $error_message = null;
public function __construct() 
{
try{
$this->conn = new PDO("mysql:host=" . $this->db_host .";dbname=" . $this->db_name, $this->db_user, $this->db_pass);
$this->conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
}catch(PDOException $error)
{echo $dx = $error->getCode();
return $this->conn;
}
}
public function __destruct()
{
$this->conn = NULL;
}
}
if(count(get_included_files()) == 1){
?>
<script> location.replace("../../"); </script>
<?php
if(session_id() !== ""){ session_destroy(); }
}
?>