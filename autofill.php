<?php
include_once 'cndb.php';
include_once 'helpers.php';

$get_couriers->execute();
$courierList = $get_couriers->fetchAll(PDO::FETCH_OBJ);
$couriers_count = count($courierList);

$get_regions->execute();
$regionList = $get_regions->fetchAll(PDO::FETCH_OBJ);
$regions_count = count($regionList);

$start_date = new DateTime('2018-05-01');
$current_date = new DateTime();
$current_date->setTime(0, 0, 0);

$days = (strtotime($current_date->format('Y-m-d')) - strtotime($start_date->format('Y-m-d')))/60/60/24|0;

for($i = 0;$i < $days; $i++){
    addTravelShedule(
        $regionList[rand(0, $regions_count - 1)]->id,
        $start_date->format('Y-m-d'),
        $courierList[rand(0, $couriers_count - 1)]->id
    );

    $start_date->add(new DateInterval('P1D'));
}
?>