<?php
require '../controller/database.php';
require 'confix.php';

$input = json_decode(file_get_contents('php://input'), true);

$database = new database(IP, DBNAME, USER, PASS);

$data = $database->update('delete from boat_schedule where boat_schedule_id = ' . $input['id'] . ' ');
if ($data == true) {
    echo json_encode($data);
}
$pdo = null; //close connection