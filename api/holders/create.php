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
require_once '../../models/Holders.php';

$database = new Database();
$db = $database->connect();

$holders = new Holder($db);
//get posted data
$data = json_decode(file_get_contents("php://input"));

$holders->firstname = $data->firstname;
$holders->secondname = $data->secondname;
$holders->nin = $data->nin;
$holders->phone = $data->phone;
$holders->dob = $data->dob;
$holders->altphone = $data->altphone;

$response = [];

if($holders->create()){
	$response['succes'] = true;
	$response['message'] = "Holder was added.";

	echo json_encode($response);
    
}else{
    $response['succes'] = false;
	$response['message'] = "Holder was  not added.";

	echo json_encode($response);
    }
