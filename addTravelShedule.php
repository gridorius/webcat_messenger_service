<?php
include_once 'cndb.php';
include_once 'helpers.php';

$region_id = $_POST['region'];
$date = $_POST['date'];
$courier_id = $_POST['courier'];

if(!empty($region_id) && !empty($date)  && !empty($courier_id)){
    addTravelShedule($region_id, $date, $courier)
}

header('location: /form.php');
?>