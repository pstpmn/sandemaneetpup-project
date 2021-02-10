<?php
require '../controller/database.php';
require 'confix.php';

$database = new database(IP, DBNAME, USER, PASS);
$data = $database->select('SELECT DISTINCT ticket_book_code from ticket_book where (ticket_status_id = 4) and (time_up_slip is not null)');
if ($data == true) {
    echo json_encode($data);
}
$pdo = null; //close connection