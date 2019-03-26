<?php
//require headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
//get database connection
require_once '../../config/database.php';
//instatiate question object
require_once '../../models/Contacts.php';

$database = new Database();
$db = $database->connect();

$message = new Contact($db);
//get posted data
$data = json_decode(file_get_contents("php://input"));

$message->name = $data->name;
$message->phone = $data->phone;
$message->message_id = $data->message_id;
//$message->latitude = $data->latitude;

$response = [];

if($message->create()){
	$response['succes'] = true;
	$response['message'] = "Message was added.";

	echo json_encode($response);
    
}else{
    $response['succes'] = false;
	$response['message'] = "Message was  not added.";

	echo json_encode($response);
    }
