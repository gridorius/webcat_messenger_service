<?php
include_once 'cndb.php';
header('content-type: application/json');
$date = new DateTime($_POST['date']);
$region = $_POST['region'];

$couriers_query = "SELECT
couriers.id,
couriers.name
FROM
couriers
LEFT JOIN travel_shedule ON travel_shedule.courier_id = couriers.id
WHERE
travel_shedule.id IS NULL
OR
departure_date NOT BETWEEN :from AND :to
AND
arrival_date NOT BETWEEN :from AND :to";

$get_days = "SELECT travel_time FROM regions WHERE id = ?";

$days = $pdo->prepare($get_days);
$days->execute([$region]);
$days = $days->fetch(PDO::FETCH_OBJ)->travel_time;

$from_format = $date->format('Y-m-d');
$to_format = $date->add(new DateInterval("P{$days}D"))->format('Y-m-d');

$between = $pdo->prepare($couriers_query);
$between->execute(['from' => $from_format, 'to' => $to_format]);

echo json_encode($between->fetchAll(PDO::FETCH_OBJ));
?>