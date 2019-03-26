<?php
header("Access-Control-Allow-Origin: *");
//header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
//header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
// include database and object files
include_once '../../config/database.php';
include_once '../../models/Messages.php';
 
// get database connection
$database = new Database();
$db = $database->connect();
 
// prepare product object
$message = new Message($db);

//set id for question to be edited
$message->holder_id = isset($_GET['holder'])?$_GET['holder']:die();

//
$message->readone();

//create array
$location_arr = array(
    "id"=>$message->id,
    "codes"=>$message->codes,
    "created_on"=>$message->created_on,
    "holder_id"=>$message->holder_id,
    "longtude"=>$message->longtude,
    "latitude"=>$message->latitude,

);
 //make it to json
if($location_arr["id"]===null){
	echo json_encode(
        array("message" => "No messages found.")
    );
}
else{
 print_r(json_encode($location_arr));
}


