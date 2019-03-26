 <?php
//require headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

//include database and oject files
include_once '../../config/database.php';
include_once '../../models/Places.php';

//instatiate database and product object
$databse = new Database();
$db = $databse->connect();

//initialize question
$place = new Place($db);

$result = $place->read();

//get row count
$num = $result->rowCount();

if($num>0){
    //place array
    $place_arr = array();
    //$place_arr['results']=array();

    //retieve 
    while($row=$result->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $place_item = array(
            "id"=>$id,
            "holder_id"=>$holder_id,
            "longtude"=>$longtude,
            "latitude"=>$latitude,
            "created_at"=>$created_at
        );
        array_push($place_arr, $place_item);

    }
    echo json_encode($place_arr);
}else{
    echo json_encode(
        array("message" => "No questions found.")
    );
}