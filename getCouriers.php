<?php
include_once 'cndb.php';
header('content-type: application/json');
$date = new DateTime($_POST['date']);
$region = $_POST['region'];

$days = $pdo->prepare($get_days);
$days->execute([$region]);
$days = $days->fetch(PDO::FETCH_OBJ)->travel_time;

$from_format = $date->format('Y-m-d');
$to_format = $date->add(new DateInterval("P{$days}D"))->format('Y-m-d');

$between = $pdo->prepare($couriers_query);
$between->execute(['from' => $from_format, 'to' => $to_format]);

echo json_encode($between->fetchAll(PDO::FETCH_OBJ));
?>