<?php
// require headers;
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
//get database connection
require_once '../../config/database.php';
//instatiate question object
require_once '../../models/Messages.php';

$database = new Database();
$db = $database->connect();

$message = new Message($db);
//get posted data
$data = json_decode(file_get_contents("php://input"));

$message->codes = $data->codes;
$message->holder_id = $data->holder_id;
// $message->phone = $data->phone;
$message->longtude = $data->longtude;
$message->latitude = $data->latitude;
// $message->create = date_time_set();

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

