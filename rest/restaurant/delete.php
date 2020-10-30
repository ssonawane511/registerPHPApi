<?php
include_once "../config.php";
include "../core/Database.php";
include "../core/Restaurant.php";

use Core\Data\Database;
use Core\Data\Restaurant;

header('Content-type: application/json');
header ( "Access-Control-Allow-Origin: *");
$db = new Database();
$Restaurant = new Restaurant($db->connect());


$Restaurant->id = $_GET['id'] ?? null;

$response = array(
    "status" => "Failed",
    "message" => "Error in deleting the  record"
);

if ( $Restaurant->delete() > 0 ) {
    $response['status'] = "Success";
    $response['message'] = "Record Deleted";
}

echo json_encode($response);

?>