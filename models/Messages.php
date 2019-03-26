<?php
class Message{
	private $conn;
	private $table_name='messagings';

	public $id, $codes, $holder_id, $longtude, $latitude, $created_on, $recieved_on, $holder;
    //send message
    public $firstname, $fname, $secondname, $sname, $phone, $altphone, $nin, $relationship, $holder_ph ;
	public function __construct($db){
            $this->conn = $db;
    }

    public function create(){
    	$query = "INSERT INTO $this->table_name SET 
                codes=:codes,
                -- phone=:phone,
                holder_id=:holder_id,
                longtude=:longtude,
                latitude=:latitude
            ";
        $stmt=$this->conn->prepare($query);

        $this->codes = htmlspecialchars(strip_tags($this->codes));
        // $this->phone = htmlspecialchars(strip_tags($this->phone));
        $this->holder_id = htmlspecialchars(strip_tags($this->holder_id));
        $this->longtude = htmlspecialchars(strip_tags($this->longtude));
        $this->latitude = htmlspecialchars(strip_tags($this->latitude));

        $stmt->bindParam(":codes",$this->codes);
        $stmt->bindParam(":holder_id",$this->holder_id);
        // $stmt->bindParam(":phone",$this->phone);
        $stmt->bindParam(":longtude",$this->longtude);
        $stmt->bindParam(":latitude",$this->latitude);

        if($stmt->execute()){
            return true;
        }
        printf("Error: %s\n",$stmt->error);
        return false;
    }
    public function read(){
        $query = "SELECT * FROM $this->table_name ORDER BY id DESC";
        $stmt = $this->conn->prepare($query);
        //execute query
        $stmt->execute();
        return $stmt;
    }
    public function readone(){
    	$query = "SELECT * FROM $this->table_name WHERE holder_id=:holder_id";    	
        $stmt=$this->conn->prepare($query);
        $this->holder_id = htmlspecialchars(strip_tags($this->holder_id));
        $stmt->bindParam(":holder_id",$this->holder_id);
        //$stmt = $this->conn->prepare($query);
       //execute
        $stmt->execute();
        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        // set values to object properties
        //echo $row;
        
        $this->id = $row['id'];
        $this->codes = $row['codes'];
        $this->holder_id = $row['holder_id'];
        $this->longtude = $row['longtude'];
        $this->latitude = $row['latitude'];
        $this->created_on = $row['created_on'];
    }

    public function sendmessages(){
        $query = "SELECT relateds.id as id,relateds.firstname as firstname, relateds.secondname as secondname, relateds.phone as phone, relateds.altphone as altphone, relateds.nin as nin, relateds.relationship as relationship, holders.firstname as fname, holders.phone as holder_ph, holders.secondname as sname, holders.id as holder_id FROM holders, relateds WHERE relateds.holder_id = holders.id AND holders.id=:holder ORDER BY relateds.id DESC";
        $stmt=$this->conn->prepare($query);
        $this->holder_id = htmlspecialchars(strip_tags($this->holder));
        $stmt->bindParam(":holder",$this->holder);
        
        $stmt->execute();
        return $stmt;

    }
}