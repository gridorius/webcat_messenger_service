<?php
include_once 'cndb.php';
header('content-type: application/json');
$date = new DateTime($_REQUEST['date']);
$region = $_REQUEST['region'];

$get_days->execute([$region]);
$days = $get_days->fetch(PDO::FETCH_OBJ)->travel_time;

$from_format = $date->format('Y-m-d');
$to_format = $date->add(new DateInterval("P{$days}D"))->format('Y-m-d');

$busy_couriers->execute(['from' => $from_format, 'to' => $to_format]);

echo json_encode($busy_couriers->fetchAll(PDO::FETCH_OBJ));
?>