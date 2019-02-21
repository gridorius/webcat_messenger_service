<?php
$pdo = new PDO('mysql:dbname=messenger_service;host=localhost;charset=utf8', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$couriers_query = 
"SELECT
id,
name
FROM
couriers as couriers_main";

$busy_couriers_query = 
"SELECT
couriers.id
FROM
couriers
LEFT JOIN travel_shedule ON travel_shedule.courier_id = couriers.id
WHERE
(
    (
    departure_date BETWEEN :from AND :to
	OR
	arrival_date BETWEEN :from AND :to
    )
    OR
    (
        departure_date <= :from
        AND
        arrival_date >= :to
    )
    OR
    (
        :from <= departure_date
        AND
        :to >= arrival_date
    )
)
AND
couriers.id = couriers_main.id
";

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
    couriers_main.id,
    :from AS departure_date,
    ADDDATE(
        CAST(:from AS DATE),
        regions.travel_time
    ) AS arrival_date
FROM
    couriers as couriers_main
LEFT JOIN travel_shedule ON travel_shedule.courier_id = couriers_main.id
LEFT JOIN regions ON regions.id = :region_id
WHERE
    NOT EXISTS(".preg_replace('/:to/', 'ADDDATE(CAST(:from AS DATE), regions.travel_time)', $busy_couriers_query).")
    AND 
    couriers_main.id = :courier_id";

$couriers = $pdo->prepare("$couriers_query WHERE NOT EXISTS($busy_couriers_query)");
$get_days = $pdo->prepare($get_days_query);
$get_regions = $pdo->prepare($get_regions_query);
$add_travel_shedule = $pdo->prepare($add_travel_shedule_query);
?>