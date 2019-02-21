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

$get_days_query = "SELECT travel_time FROM regions WHERE id = ?";

$get_regions_query = "SELECT id, name, travel_time FROM regions";

$add_travel_shedule_query = "
INSERT INTO `travel_shedule`(
    `region_id`,
    `courier_id`,
    `departure_date`,
    `arrival_date`
)
SELECT
    :region_id AS region_id,
    couriers.id,
    :from AS departure_date,
    ADDDATE(
        CAST(:from AS DATE),
        regions.travel_time
    ) AS arrival_date
FROM
    couriers
LEFT JOIN travel_shedule ON travel_shedule.courier_id = couriers.id
LEFT JOIN regions ON regions.id = 1
WHERE
    (
        travel_shedule.id IS NULL OR departure_date NOT BETWEEN :from' AND ADDDATE(CAST(:from AS DATE), regions.travel_time)
        AND 
        arrival_date NOT BETWEEN :from AND ADDDATE(CAST(:from AS DATE), regions.travel_time)
    ) AND couriers.id = :courier_id;


$couriers = $pdo->prepare($couriers_query);
$get_days = $pdo->prepare($get_days_query);
$get_regions = $pdo->prepare($get_regions_query);
$add_travel_shedule = $pdo->prepare($add_travel_shedule_query);
?>