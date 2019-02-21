<ol>
<?php
include_once 'cndb.php';
$all_travels->execute();
foreach($all_travels->fetchAll(PDO::FETCH_OBJ) as $travel){
    echo "<li>{$travel->name} с{$travel->departure_date} по {$travel->arrival_date}</li>";
}
?>
</ol>