<?php
require '../../../controller/database.php';
require '../../confix.php';

$input = json_decode(file_get_contents('php://input'), true);
$database = new database(IP, DBNAME, USER, PASS);

$data = $database->select("SELECT count(IF(MONTH(travel_date) = 1 , 1 , NULL)) as month1, count(IF(MONTH(travel_date) = 2 , 1 , NULL)) as month2
, count(IF(MONTH(travel_date) = 3 , 1 , NULL)) as month3, count(IF(MONTH(travel_date) = 4 , 1 , NULL)) as month4
, count(IF(MONTH(travel_date) = 5 , 1 , NULL))  as month5, count(IF(MONTH(travel_date) = 6 , 1 , NULL)) as month6
, count(IF(MONTH(travel_date) = 7 , 1 , NULL)) as month7 , count(IF(MONTH(travel_date) = 8 , 1 , NULL)) as month8
, count(IF(MONTH(travel_date) = 9 , 1 , NULL)) as month9, count(IF(MONTH(travel_date) = 10 , 1 , NULL)) as month10
, count(IF(MONTH(travel_date) = 11 , 1 , NULL)) as month11, count(IF(MONTH(travel_date) = 12 , 1 , NULL)) as month12 
from buy_ticket
JOIN ticket_book on ticket_book.ticket_book_id = buy_ticket.ticket_book_id
where YEAR(travel_date) =  '" . $input['date'] . "' AND (buy_ticket.check_in is not null OR buy_ticket.check_out is not null)");
echo json_encode($data);
