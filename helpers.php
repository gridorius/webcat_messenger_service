<?php
function addTravelShedule($region_id, $date, $courier_id){
    global $add_travel_shedule;
    
    $add_travel_shedule->execute([
        'region_id' => $region_id,
        'from' => $date,
        'courier_id' => $courier_id
    ]);
}
?>