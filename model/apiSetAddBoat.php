<?php
require '../controller/database.php';
require 'confix.php';

$input = json_decode(file_get_contents('php://input'), true);

$database = new database(IP, DBNAME, USER, PASS);

$data = $database->insert('insert into boat(boat_number,boat_name)
values (' . $input['boatNumber'] . ',"' . $input['boatName'] . '") ');
if ($data == true) {
    echo json_encode($data);
}
$pdo = null; //close connection