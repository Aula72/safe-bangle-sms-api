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
require_once '../../models/Relateds.php';

$database = new Database();
$db = $database->connect();

$related = new Related($db);

//get posted data
$data = json_decode(file_get_contents("php://input"));
//$question->questionId = isset($_GET['id'])?$_GET['id']:die();
$related->id = isset($_GET['id'])?$_GET['id']:die();
// $related->holder_id = isset($_GET['holder_id'])?$_GET['holder_id']:die();
//set question property values
$related->firstname = $data->firstname;
$related->secondname = $data->secondname;
$related->nin = $data->nin;
$related->phone = $data->phone;
$related->relationship = $data->relationship;
$related->altphone = $data->altphone;
// $related->holder_id = $data->holder_id;

//create the product
if($related->update()){
    echo "[{";
        echo '"message": "Holder was update."';
    echo "}]";
}else{
    echo "[{";
        echo '"message": "Holder was not update."';
    echo "}]";
}
?>