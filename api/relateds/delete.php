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
require_once '../../models/Relateds.php';

$database = new Database();
$db = $database->connect();

$related = new Related($db);
//get posted data
$data = json_decode(file_get_contents("php://input"));

$related->id = isset($_GET['id'])?$_GET['id']:die();


if($related->delete()){
    echo "{";
        echo '"message": "Related was deleted."';
    echo "}";
}else{
    echo "{";
        echo '"message": "Related was not deleted."';
    echo "}";
}
