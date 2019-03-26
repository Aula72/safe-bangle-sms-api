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
require_once '../../models/Relateds.php';

$database = new Database();
$db = $database->connect();

$related = new Related($db);
//get posted data
$data = json_decode(file_get_contents("php://input"));

$related->holder_id = $data->holder_id;
$related->firstname = $data->firstname;
$related->secondname = $data->secondname;
$related->nin = $data->nin;
$related->phone = $data->phone;
$related->altphone = $data->altphone;
$related->relationship = $data->relationship;

$response = [];

if($related->create()){
	$response['succes'] = true;
	$response['message'] = "Relation was added.";

	echo json_encode($response);
    
}else{
    $response['succes'] = false;
	$response['message'] = "Relation was  not added.";

	echo json_encode($response);
    }
