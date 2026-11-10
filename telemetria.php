<!DOCTYPE html>

<?php
    # Dati grezzi in ms
    $ping_grezzi = [45, 120, -1, 32, 210, 85, -1, 18, 95, 310, 45, 60, -1, 150, 28, 240, 18, 72];
    $ping_validi = [];
    $pacchetti_persi = 0;
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Telemetria </title>
</head>
<body>
    <h1> Analizzatore di Telemetria Server </h1>

    <?php
        $ping_grezzi[] = 55;
        $ping_grezzi[] = 190;
        $ping_grezzi[] = 12;
    ?>

    <h2> Ping Grezzi </h2>

    <ul>
        <?php foreach($ping_grezzi as $ping): ?>
            <?= "<li " ?>

            <?php if($ping == -1): ?>
                <li style="color: red">
                <?php $pacchetti_persi++ ?>
            <?php elseif($ping >= 0): ?>
                <li style="color: green">
                <?php $ping_validi[] = $ping ?>
            <?php endif; ?>

            <?= $ping ?>

            </li>
        <?php endforeach; ?>
    </ul>

    <p>
        Numero di pacchetti persi:
        <?= $pacchetti_persi ?>
    </p>
</body>
</html>