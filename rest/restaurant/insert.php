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
$Restaurant->fname = $_GET['fname'] ?? null;
$Restaurant->lname = $_GET['lname'] ?? null;
$Restaurant->email = $_GET['email'] ?? null;
$Restaurant->phone = $_GET['phone'] ?? null;
$Restaurant->age = $_GET['age'] ?? null;

$response = array(
    "status" => "Failed",
    "message" => "Error in inserting the  record"
);

if ($Restaurant->insert() > 0 ) {
    $response['status'] = "Success";
    $response['message'] = "Record inserted";
}

echo json_encode($response);

?>