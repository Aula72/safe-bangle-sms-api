<?php
class Related{
	private $conn;
	private $table_name = "relateds";

	public $id, $holder_id, $firstname, $secondname, $nin, $phone, $altphone, $relationship, $created_at;

    public function __construct($db){
        $this->conn = $db;
    }
    public function create(){
        $query = "INSERT INTO $this->table_name SET 
            holder_id=:holder_id,
            firstname=:firstname,
            secondname=:secondname,
            nin=:nin,
            phone=:phone,
            altphone=:altphone,
            relationship=:relationship
        ";
        $stmt=$this->conn->prepare($query);

        $this->holder_id = htmlspecialchars(strip_tags($this->holder_id));
        $this->firstname = htmlspecialchars(strip_tags($this->firstname));
        $this->secondname = htmlspecialchars(strip_tags($this->secondname));
        $this->nin = htmlspecialchars(strip_tags($this->nin));
        $this->phone = htmlspecialchars(strip_tags($this->phone));
        $this->altphone = htmlspecialchars(strip_tags($this->altphone));
        $this->relationship = htmlspecialchars(strip_tags($this->relationship));

        $stmt->bindParam(":holder_id",$this->holder_id);
        $stmt->bindParam(":firstname",$this->firstname);
        $stmt->bindParam(":secondname",$this->secondname);
        $stmt->bindParam(":nin",$this->nin);
        $stmt->bindParam(":phone",$this->phone);
        $stmt->bindParam(":altphone",$this->altphone);
        $stmt->bindParam(":relationship",$this->relationship);
        
        if($stmt->execute()){
            return true;
        }
        printf("Error: %s\n",$stmt->error);
        return false;
    }
    public function delete(){
        $query = "DELETE FROM $this->table_name WHERE id=:id";
        $stmt = $this->conn->prepare($query);
        $this->id = htmlspecialchars(strip_tags($this->id));
        $stmt->bindParam(":id", $this->id);
        if($stmt->execute()){
            return true;
        }
    }
    public function update(){
        $query = "UPDATE $this->table_name SET 
            firstname=:firstname,
            secondname=:secondname,
            phone=:phone,
            altphone=:altphone,
            relationship=:relationship,
            nin=:nin
            WHERE id=:id 
            -- AND holder_id=:holder_id
        ";
        $stmt=$this->conn->prepare($query);

        $this->firstname = htmlspecialchars(strip_tags($this->firstname));
        $this->secondname = htmlspecialchars(strip_tags($this->secondname));
        $this->phone = htmlspecialchars(strip_tags($this->phone));
        $this->altphone = htmlspecialchars(strip_tags($this->altphone));
        $this->relationship = htmlspecialchars(strip_tags($this->relationship));
        $this->nin = htmlspecialchars(strip_tags($this->nin));
        $this->id = htmlspecialchars(strip_tags($this->id));
        // $this->holder_id = htmlspecialchars(strip_tags($this->holder_id));

        $stmt->bindParam(":firstname",$this->firstname);
        $stmt->bindParam(":secondname",$this->secondname);
        $stmt->bindParam(":nin",$this->nin);
        $stmt->bindParam(":relationship",$this->relationship);
        $stmt->bindParam(":phone",$this->phone);
        $stmt->bindParam(":altphone",$this->altphone);
        $stmt->bindParam(":id",$this->id);
        // $stmt->bindParam(":holder_id",$this->holder_id);

        if($stmt->execute()){
            return true;
        }
        printf("Error: %s\n",$stmt->error);
        return false;
    }
    public function read(){
        $query = "SELECT * FROM $this->table_name";
        $stmt = $this->conn->prepare($query);
        //execute query
        $stmt->execute();
        return $stmt;
    }
    public function readone(){
        $query = "SELECT * FROM $this->table_name WHERE id=:id";
        $stmt=$this->conn->prepare($query);
        $this->id = htmlspecialchars(strip_tags($this->id));
        $stmt->bindParam(":id",$this->id);
        //$stmt = $this->conn->prepare($query);
       //execute
        $stmt->execute();
        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        // set values to object properties
        //echo $row;
        
        $this->id = $row['id'];
        $this->holder_id = $row['holder_id'];
        $this->phone = $row['phone'];
        $this->altphone = $row['altphone'];
        $this->firstname = $row['firstname'];
        $this->nin = $row['nin'];
        $this->secondname = $row['secondname'];
        $this->created_at = $row['created_at'];
        $this->relationship = $row['relationship'];
        $this->holder_id = $row['holder_id'];
    }


    public function readsome(){
        $query = "SELECT *  FROM $this->table_name WHERE holder_id=:holder_id";
        $stmt=$this->conn->prepare($query);
        $this->holder_id = htmlspecialchars(strip_tags($this->holder_id));
        $stmt->bindParam(":holder_id",$this->holder_id);
        
        $stmt->execute();
        return $stmt;
    }
}