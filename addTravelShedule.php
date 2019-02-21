<?php
include_once 'cndb.php';

$region_id = $_POST['region'];
$date = $_POST['date'];
$courier_id = $_POST['courier'];

if(!empty($region_id) && !empty($date)  && !empty($courier_id)){
    $add_travel_shedule->execute([
        'region_id' => $region_id,
        'from' => $date,
        'courier_id' => $courier_id
    ]);
}

// header('location: /form.php');
?>