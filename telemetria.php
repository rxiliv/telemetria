<!DOCTYPE html>

<?php
    # Dati grezzi in ms
    $ping_grezzi = [45, 120, -1, 32, 210, 85, -1, 18, 95, 310, 45, 60, -1, 150, 28, 240, 18, 72];
    $ping_validi = [];
    $ping_critici = [];
    $ping_unici = [];
    $pacchetti_persi = 0;

    $ping_grezzi[] = 55;
    $ping_grezzi[] = 190;
    $ping_grezzi[] = 12;

    foreach($ping_grezzi as $ping) {
        if ($ping >= 0) {
            $ping_validi[] = $ping;

            if ($ping >= 150) {
                $ping_critici = $ping;
            }
        }
    }

    $ping_unici = array_unique($ping_validi);

    function media($array) {
        $somma = 0;

        foreach($array as $value) {
            $somma += $value;
        }

        return round($somma / count($array), 2);
    }

    function massimo($array) {
        $massimo = $array[0];

        foreach($array as $value) {
            if ($value > $massimo) {
                $massimo = $value;
            }
        }

        return $massimo;
    }

    function minimo($array) {
        $minimo = $array[0];

        foreach($array as $value) {
            if ($value < $minimo) {
                $minimo = $value;
            }
        }

        return $minimo;
    }
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Telemetria </title>
</head>
<body>
    <h1> Analizzatore di Telemetria Server </h1>

    <h2> Ping Grezzi </h2>

    <ul>
        <?php foreach($ping_grezzi as $ping): ?>
            <?= "<li " ?>

            <?php if($ping == -1): ?>
                <li style="color: red">
                <?php $pacchetti_persi++; ?>

            <?php elseif($ping >= 0): ?>
                <?php if($ping >= 150): ?>
                    <li style="color: orange">

                <?php else: ?>
                    <li style="color: green">
                <?php endif; ?>
            <?php endif; ?>

            <?= $ping ?>

            </li>
        <?php endforeach; ?>
    </ul>

    <p>
        Numero di pacchetti persi:
        <?= $pacchetti_persi ?>
    </p>

    <h2> Informazioni Utili </h2>
    <ul>
        <li> Tempo medio: <?= media($ping_validi) ?> </li>
        <li> Ping massimo: <?= massimo($ping_validi) ?> </li>
        <li> Ping minimo: <?= minimo($ping_validi) ?> </li>
    </ul>
</body>
</html>