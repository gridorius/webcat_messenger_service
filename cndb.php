<?php
$pdo = new PDO('mysql:dbname=messenger_service;host=localhost;charset=utf8', 'root', '');

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

$get_days = "SELECT travel_time FROM regions WHERE name = ?";
?>