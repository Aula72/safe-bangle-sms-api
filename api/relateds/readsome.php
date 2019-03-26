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
$related = new Related($db);

//set id for question to be edited
$related->holder_id = isset($_GET['holder_id'])?$_GET['holder_id']:die();

//
$result = $related->readsome();
$num = $result->rowCount();
$loc_all = array();

//while ($result<100) {
	# code...
if($num>0){
    //related array
    $related_arr = array();
    //$related_arr['results']=array();

    //retieve 
    while($row=$result->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $related_item=array(
            "id"=>$id,
            "holder_id"=>$holder_id,
            "firstname"=>$firstname,
            "secondname"=>$secondname,
            "phone"=>$phone,
            "altphone"=> $altphone,
            "created_at"=>$created_at,
            "nin"=>$nin
        );
        array_push($related_arr, $related_item);
    }
    echo json_encode($related_arr);
}else{
    echo json_encode(
        [array("message" => "This SafeBangle holder has not yet registered any contacts, you may help her in the registration of atmost four members by pressing the blue button below. Thanks!")]
    );
}
// $num = $result->rowCount();

// if($num>0){
//     //location array
//     $location_arr = array();
//     //$location_arr['results']=array();

//     //retieve 
//     while($row=$result->fetch(PDO::FETCH_ASSOC)){
//         extract($row);
//         $location_item=array(
//             "locationId"=>$locationId,
//             "locationName"=>$locationName,
//             "locationLatitude"=>$locationLatitude,
//             "locationLongtude"=>$locationLongtude,
//             "adminId"=>$adminId
//         );
//         array_push($location_arr, $location_item);


//     }
//     echo json_encode($location_arr);
// }else{
//     echo json_encode(
//         array("message" => "No locations found.")
//     );
// }