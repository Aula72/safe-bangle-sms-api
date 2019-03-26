<?php
//require headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

//include database and oject files
include_once '../../config/database.php';
include_once '../../models/Holders.php';

//instatiate database and product object
$databse = new Database();
$db = $databse->connect();

//initialize question
$holder = new Holder($db);

$result = $holder->read();
//pagination
$result_per_page = 7;

//get row count

$num = $result->rowCount();
// echo $num;
$num_pages = ceil($num/$result_per_page);
if($num>0){
    //holder array
    $holder_arr = array();
    // $holder_arr['results']=array();

    //retieve 
    while($row=$result->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $holder_item = array(
            "id"=>$id,
            "firstname"=>$firstname,
            "secondname"=>$secondname,
            "nin"=>$nin,
            "phone"=>$phone,
            "dob"=>$dob,
            "altphone"=>$altphone,
            "created_at"=>$created_at
        );
        array_push($holder_arr, $holder_item);

    }
    echo json_encode($holder_arr);
}else{
    echo json_encode(
        array("message" => "No questions found.")
    );
}