<?php
header("Access-Control-Allow-Origin: *");
//header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
//header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
// include database and object files
include_once '../../config/database.php';
include_once '../../models/Contacts.php';
$database = new Database();
$db = $database->connect();
$contact = new Contact($db);
$contact->my_id = isset($_GET['my_id'])?$_GET['my_id']:die();

//
$result = $contact->read();
$num = $result->rowCount();
$loc_all = array();

//while ($result<100) {
	# code...
if($num>0){
    //location array
    $location_arr = array();
    while($row=$result->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $location_item=array(
            "id"=>$id,
            "name"=>$name,
            "phone"=>$phone
        );
        array_push($location_arr, $location_item);
    }
    echo json_encode($location_arr);
}else{
    echo json_encode(
        array("message" => "No contacts found.")
    );
}