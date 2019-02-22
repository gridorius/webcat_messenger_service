<?php
include_once 'cndb.php';

$get_couriers->execute();

$couriers = $get_couriers->fetchAll(PDO::FETCH_OBJ);

foreach($couriers as $courier){
    $get_travels->execute([$courier->id]);
    $courier->travels = $get_travels->fetchAll(PDO::FETCH_OBJ);
}
?>

<ol>
    <?php foreach($couriers as $courier):?>
        <li style='padding:20px;'>
            <?php echo $courier->name?>
            <ul>
                <?php foreach($courier->travels as $travel):?>
                    <li>
                    <?php echo "c {$travel->departure_date}     по {$travel->arrival_date}"?>
                    </li>
                <?php endforeach?> 
            </ul>
        </li>
    <?php endforeach?>  
</ol>