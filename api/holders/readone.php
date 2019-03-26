<?php
header("Access-Control-Allow-Origin: *");
//header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
//header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
// include database and object files
include_once '../../config/database.php';
include_once '../../models/Holders.php';
 
// get database connection
$database = new Database();
$db = $database->connect();
 
// prepare product object
$holder = new Holder($db);

//set id for question to be edited
$holder->id = isset($_GET['id'])?$_GET['id']:die();

//
$holder->readone();

//create array
$location_arr = array(
    "id"=>$holder->id,
    "firstname"=>$holder->firstname,
    "secondname"=>$holder->secondname,
    "phone"=>$holder->phone,
    "altphone"=>$holder->altphone,
    "created_at"=>$holder->created_at,
    "nin"=>$holder->nin,
    "dob"=>$holder->dob,
    

);
 //make it to json
 print_r(json_encode($location_arr));