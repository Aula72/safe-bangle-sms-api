<?php
header("Access-Control-Allow-Origin: *");
//header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
//header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
// include database and object files
include_once '../../config/database.php';
include_once '../../models/Places.php';
 
// get database connection
$database = new Database();
$db = $database->connect();
 
// prepare product object
$place = new Place($db);

//set id for question to be edited
$place->holder_id = isset($_GET['holder_id'])?$_GET['holder_id']:die();

//
$result = $place->readsome();
$num = $result->rowCount();
$loc_all = array();

//while ($result<100) {
	# code...
if($num>0){
    //related array
    $related_arr = array();
    //$related_arr['results']=array();

    //retieve 
    while($row=$result->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $related_item=array(
            "id"=>$id,
            "holder_id"=>$holder_id,
            "longtude"=>$longtude,
            "latitude"=>$latitude,            
            "created_at"=>$created_at
        );
        array_push($related_arr, $related_item);
    }
    echo json_encode($related_arr);
}else{
    echo json_encode(
        [array("message" => "No places found.")]
    );
}