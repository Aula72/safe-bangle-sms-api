<?php
class Holder{
	private $conn;
	private $table_name = "holders";

	public $id, $firstname, $dob, $secondname, $nin, $phone, $altphone,  $created_at;

    public function __construct($db){
        $this->conn = $db;
    }
    public function create(){
        $query = "INSERT INTO $this->table_name SET 
            
            firstname=:firstname,
            secondname=:secondname,
            nin=:nin,
            phone=:phone,
            altphone=:altphone,
            dob=:dob
        ";
        $stmt=$this->conn->prepare($query);

        $this->firstname = htmlspecialchars(strip_tags($this->firstname));
        $this->secondname = htmlspecialchars(strip_tags($this->secondname));
        $this->nin = htmlspecialchars(strip_tags($this->nin));
        $this->phone = htmlspecialchars(strip_tags($this->phone));
        $this->altphone = htmlspecialchars(strip_tags($this->altphone));
        $this->dob = htmlspecialchars(strip_tags($this->dob));

        $stmt->bindParam(":dob",$this->dob);
        $stmt->bindParam(":firstname",$this->firstname);
        $stmt->bindParam(":secondname",$this->secondname);
        $stmt->bindParam(":nin",$this->nin);
        $stmt->bindParam(":phone",$this->phone);
        $stmt->bindParam(":altphone",$this->altphone);
        
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
            nin=:nin,
            dob=:dob
            WHERE id=:id
        ";
        $stmt=$this->conn->prepare($query);

        $this->firstname = htmlspecialchars(strip_tags($this->firstname));
        $this->secondname = htmlspecialchars(strip_tags($this->secondname));
        $this->phone = htmlspecialchars(strip_tags($this->phone));
        $this->altphone = htmlspecialchars(strip_tags($this->altphone));
        $this->nin = htmlspecialchars(strip_tags($this->nin));
        $this->dob = htmlspecialchars(strip_tags($this->dob));
        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(":firstname",$this->firstname);
        $stmt->bindParam(":secondname",$this->secondname);
        $stmt->bindParam(":nin",$this->nin);
        $stmt->bindParam(":phone",$this->phone);
        $stmt->bindParam(":altphone",$this->altphone);
        $stmt->bindParam(":dob",$this->dob);
        $stmt->bindParam(":id",$this->id);

        if($stmt->execute()){
            return true;
        }
        printf("Error: %s\n",$stmt->error);
        return false;
    }
    public function read(){
        if(@$_GET['page'] && @$_GET['rows']){
            $page = $_GET['page'];
            $rows = $_GET['rows'];
            $begin = ($page*$rows) - $rows;
            $query = "SELECT * FROM $this->table_name LIMIT {$begin},{$rows}";
        }
        
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
        $this->firstname = $row['firstname'];
        $this->secondname = $row['secondname'];
        $this->nin = $row['nin'];
        $this->dob = $row['dob'];
        $this->phone = $row['phone'];
        $this->altphone = $row['altphone'];
        $this->created_at = $row['created_at'];
    }
    public function readsome(){
        $query = "SELECT locations.id, centers.centerName as cent,locations.locationLongtude, locations.locationLatitude, locations.admin_id, locations.locationName,  centers.centerType  FROM $this->table_name, centers WHERE .centers.centerType=:centerType AND locations.id=centers.locations_id";
        $stmt=$this->conn->prepare($query);
        $this->centerType = htmlspecialchars(strip_tags($this->centerType));
        $stmt->bindParam(":centerType",$this->centerType);
        
        $stmt->execute();
        return $stmt;
    }
}
 