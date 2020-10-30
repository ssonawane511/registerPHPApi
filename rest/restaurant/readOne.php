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

$stmt = $Restaurant->getRegistration();


$row = array();

if (isset($_GET['id'])) {

    $Restaurant->id = $_GET['id'];
    $stmt =  $Restaurant->getRegistrationById();
    $row = $stmt->fetch(\PDO::FETCH_ASSOC);

}

echo json_encode($row);

?>