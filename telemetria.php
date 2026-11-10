<!DOCTYPE html>

<?php
    # Dati
    $ping_grezzi = [45, 120, -1, 32, 210, 85, -1, 18, 95, 310, 45, 60, -1, 150, 28, 240, 18, 72];
    $ping_validi = [];
    $ping_critici = [];
    $pacchetti_persi = 0;

    # Inizializzazione e modifiche variabili
    $ping_grezzi[] = 55;
    $ping_grezzi[] = 190;
    $ping_grezzi[] = 12;

    foreach($ping_grezzi as $ping) {
        if ($ping == -1) {
            $pacchetti_persi++;
        }
        elseif ($ping >= 0) {
            $ping_validi[] = $ping;

            if ($ping >= 150) {
                $ping_critici = $ping;
            }
        }
    }

    $ping_unici = array_unique($ping_validi);

    $ping_ordinati = $ping_validi;
    sort($ping_ordinati);

    $top_3_veloci = array_slice($ping_ordinati, 0, 3);

    $controllo_100ms = in_array(100, $ping_validi) ? "Sì" : "No";



    # --- Funzioni ---

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

    <h2> Riepilogo </h2>

    <ul>
        <li> <?= count($ping_grezzi) ?> pacchetti rilevati </li>
        <li> <?= count($ping_validi) ?> pacchetti validi </li>
        <li> <?= $pacchetti_persi ?> pacchetti persi </li>

        <li> Tempo medio: <?= media($ping_validi) ?> </li>
        <li> Ping minimo: <?= minimo($ping_validi) ?> </li>
        <li> Ping massimo: <?= massimo($ping_validi) ?> </li>

        <li> E' presente un ping pari a 100ms? <?= $controllo_100ms ?> </li>
    </ul>

    <h3> 3 tempi migliori </h2>
    <p> <?= implode("ms - ", $top_3_veloci); ?>ms </p>

    <table>
        <thead>
            <tr>
                <th> n. prog. </th>
                <th> valore (ms) </th>
                <th> stato </th>
            </tr>
        </thead>

        <tbody>
            <?php foreach($ping_validi as $index => $ping): ?>
                <tr>
                    <td> <?= $index + 1 ?> </td>
                    <td> <?= $ping ?> </td>
                    <td>
                        <?php if($ping >= 150): ?>
                            <?= "CRITICO" ?>
                        <?php else: ?>
                            <?= "NORMALE" ?>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>