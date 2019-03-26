<?php
//require headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

//include database and oject files
include_once '../../config/database.php';
include_once '../../models/Messages.php';

//instatiate database and product object
$databse = new Database();
$db = $databse->connect();

//initialize question
$message = new Message($db);

$result = $message->read();

//get row count
$num = $result->rowCount();

if($num>0){
    //message array
    $message_arr = array();
    //$message_arr['results']=array();

    //retieve 
    while($row=$result->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $message_item=array(
            "id"=>$id,
            "holder_id"=>$holder_id,
            "codes"=>$codes,
            "created_on"=>$created_on,
            "longtude"=>$longtude,
            "latitude"=>$latitude,
            // "date_called"=>$date_called
        );
        array_push($message_arr, $message_item);
    }
    echo json_encode($message_arr);
}else{
    echo json_encode(
        array("message" => "No messages found.")
    );
}