<?php
class Database{
	private $host = 'localhost';
    //private $db_name = 'centers_for_her';
    private $db_name = 'safe_bangle';
    private $username = 'root';
    private $password = '';
    public $conn;
    // public $_SESSION['_token']="kjkdf"; //= bin2hex(openssl_random_pseudo_bytes(16));
    public function connect(){
            $this->conn = null;
            try{
                $this->conn = new PDO("mysql:host=".$this->host.";dbname=".$this->db_name, $this->username, $this->password);
                //$this->conn->exec("st name utf8"); 
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);               
            }catch(PDOException $exception){
                echo "Connection error: ".$exception->getMessage();
            }
            return $this->conn;
    }
}
?>