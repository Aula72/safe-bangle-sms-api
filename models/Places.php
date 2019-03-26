<?php
class Place{
	private $conn;
	private $table_name='places';

	public $id, $holder_id, $longtude, $latitude, $created_at;
	public function __construct($db){
            $this->conn = $db;
    }

    public function create(){
    	$query = "INSERT INTO $this->table_name SET 
                holder_id=:holder_id,
                longtude=:longtude,
                latitude=:latitude
            ";
        $stmt=$this->conn->prepare($query);

        $this->holder_id = htmlspecialchars(strip_tags($this->holder_id));
        $this->longtude = htmlspecialchars(strip_tags($this->longtude));        
        $this->latitude = htmlspecialchars(strip_tags($this->latitude));

        $stmt->bindParam(":holder_id",$this->holder_id);
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

    public function delete(){
        $query = "DELETE FROM $this->table_name WHERE id=:id";
        $stmt = $this->conn->prepare($query);
        $this->id = htmlspecialchars(strip_tags($this->id));
        $stmt->bindParam(":id", $this->id);
        if($stmt->execute()){
            return true;
        }
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
        $this->longtude = $row['longtude'];
        $this->latitude = $row['latitude'];
        $this->created_at = $row['created_at'];
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