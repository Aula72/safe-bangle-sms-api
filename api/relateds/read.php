<?php
//require headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

//include database and oject files
include_once '../../config/database.php';
include_once '../../models/Relateds.php';

//instatiate database and product object
$databse = new Database();
$db = $databse->connect();

//initialize question
$related = new Related($db);

$result = $related->read();

//get row count
$num = $result->rowCount();

if($num>0){
    //related array
    $related_arr = array();
    // $related_arr['results']=array();

    //retieve 
    while($row=$result->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $related_item = array(
            "id"=>$id,
            "firstname"=>$firstname,
            "secondname"=>$secondname,
            "nin"=>$nin,
            "phone"=>$phone,
            "altphone"=>$altphone,
            "created_at"=>$created_at
        );
        array_push($related_arr, $related_item);

    }
    echo json_encode($related_arr);
}else{
    echo json_encode(
        array("message" => "No questions found.")
    );
}