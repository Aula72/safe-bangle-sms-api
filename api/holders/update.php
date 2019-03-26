<?php
//require headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: PUT");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
//get database connection
require_once '../../config/database.php';
//instatiate vquestion object
require_once '../../models/Holders.php';

$database = new Database();
$db = $database->connect();

$holder = new Holder($db);

//get posted data
$data = json_decode(file_get_contents("php://input"));
$holder->id = isset($_GET['id'])?$_GET['id']:die();
// $holder->id = $data->id;
//set question property values
$holder->firstname = $data->firstname;
$holder->secondname = $data->secondname;
$holder->nin = $data->nin;
$holder->phone = $data->phone;
$holder->dob = $data->dob;
$holder->altphone = $data->altphone;


//create the product
if($holder->update()){
    echo "{";
        echo '"message": "Holder was update."';
    echo "}";
}else{
    echo "{";
        echo '"message": "Holder was not update."';
    echo "}";
}
?>