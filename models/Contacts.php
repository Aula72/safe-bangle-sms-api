<?php
class Contact{
	private $conn;
	private $table_name='contacts';

	public $id, $name, $phone, $message_id, $my_id;
	public function __construct($db){
            $this->conn = $db;
    }

    public function create(){
    	$query = "INSERT INTO $this->table_name SET 
                name=:name,
                phone=:phone,
                message_id=:message_id
            ";
        $stmt=$this->conn->prepare($query);

        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->phone = htmlspecialchars(strip_tags($this->phone));
        $this->message_id = htmlspecialchars(strip_tags($this->message_id));
        // $this->latitude = htmlspecialchars(strip_tags($this->latitude));

        $stmt->bindParam(":name",$this->name);
        $stmt->bindParam(":phone",$this->phone);
        $stmt->bindParam(":message_id",$this->message_id);

        if($stmt->execute()){
            return true;
        }
        printf("Error: %s\n",$stmt->error);
        return false;
    }
    public function read(){
        $query = "SELECT * FROM $this->table_name WHERE message_id=:my_id";
        $stmt=$this->conn->prepare($query);
        $this->my_id = htmlspecialchars(strip_tags($this->my_id));
        $stmt->bindParam(":my_id",$this->my_id);
        // echo $_SESSION['_token'];
        $stmt->execute();

        
        return $stmt;
    }
}