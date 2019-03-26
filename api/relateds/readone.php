<?php
header("Access-Control-Allow-Origin: *");
//header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
//header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
// include database and object files
include_once '../../config/database.php';
include_once '../../models/Relateds.php';
 
// get database connection
$database = new Database();
$db = $database->connect();
 
// prepare product object
$reladed = new Related($db);

//set id for question to be edited
$reladed->id = isset($_GET['id'])?$_GET['id']:die();

//
$reladed->readone();

//create array
$location_arr = array(
    "id"=>$reladed->id,
    "firstname"=>$reladed->firstname,
    "secondname"=>$reladed->secondname,
    "phone"=>$reladed->phone,
    "altphone"=>$reladed->altphone,
    "created_at"=>$reladed->created_at,
    "nin"=>$reladed->nin,
    "relationship"=>$reladed->relationship,
    "holder_id"=>$reladed->holder_id 
);
 //make it to json
 print_r(json_encode($location_arr));