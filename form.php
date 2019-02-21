<?php include_once('cndb.php')?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="addTravelShedule.php" method='post'>
        <label for="regions">Выберите регион</label>
        <select name="region" id="regions">
            <?php
                $get_regions->execute();
                foreach($get_regions->fetchAll(PDO::FETCH_OBJ) as $region)
                    echo "<option data-travel-time='{$region->travel_time}' value='{$region->id}'>{$region->name}</option>";
            ?>
        </select>
        <br>
        <label for="date">Выберите дату выезда</label>
        <input type="date" name='date' id='date'>
        <br>
        <label for="couriers">Свободные курьеры</label>
        <select name="courier" id="couriers"></select>
        <br>
        <label for="arrival_date">Дата прибытия</label>
        <input type="text" id='arrival_date' readonly>
        <br>
        <input type="submit" value='Отправить'>
    </form>

    <script src='main.js'></script>
</body>
</html>