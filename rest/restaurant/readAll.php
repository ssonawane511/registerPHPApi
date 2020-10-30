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

if ($stmt->rowCount() > 0) {
    $Restaurant_arr = array(
        "records" => array()
    );

    while($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
        $Restaurant_arr['records'][] = $row;
    }

    echo json_encode($Restaurant_arr);
}
?>