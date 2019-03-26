<?php
//require headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: DELETE");
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

$place->id = isset($_GET['id'])?$_GET['id']:die();


if($place->delete()){
    echo "{";
        echo '"message": "Place was deleted."';
    echo "}";
}else{
    echo "{";
        echo '"message": "Place was not deleted."';
    echo "}";
}
