 <?php
header("Access-Control-Allow-Origin: *");
//header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
//header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
// include database and object files
include_once '../../config/database.php';
include_once '../../models/Places.php';
 
// get database connection
$database = new Database();
$db = $database->connect();
 
// prepare product object
$place = new Place($db);

//set id for question to be edited
$place->id = isset($_GET['id'])?$_GET['id']:die();

//
$place->readone();

//create array
$location_arr = array(
    "id"=>$place->id,
    "holder_id"=>$place->holder_id,
    "longtude"=>$place->longtude,
    "latitude"=>$place->latitude,
    "created_at"=>$place->created_at 
);
 //make it to json
 print_r(json_encode($location_arr));