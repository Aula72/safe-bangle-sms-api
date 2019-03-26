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
require_once '../../models/Places.php';

$database = new Database();
$db = $database->connect();

$place = new Place($db);
//get posted data
$data = json_decode(file_get_contents("php://input"));

$place->holder_id = $data->holder_id;
$place->longtude = $data->longtude;
$place->latitude = $data->latitude;

$response = [];

if($place->create()){
	$response['succes'] = true;
	$response['message'] = "Place was added.";

	echo json_encode($response);
    
}else{
    $response['succes'] = false;
	$response['message'] = "Place was  not added.";

	echo json_encode($response);
    }
