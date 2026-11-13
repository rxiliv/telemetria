<!DOCTYPE html>

<!-- Elaborazione dei dati -> BACKEND -->
<?php
    # --- FUNZIONI ---
    /*
    conta_pacchetti_persi accetta un array di interi e restituisce un numero intero
    */
    function conta_pacchetti_persi($ping_grezzi) {
        $pacchetti_persi = 0;

        foreach($ping_grezzi as $ping) {
            if ($ping == -1) {
                $pacchetti_persi++;
            }
        }

        return $pacchetti_persi;
    }

    /*
    pacchetti_validi accetta un array di interi e restituisce un array di interi
    */
    function pacchetti_validi($ping_grezzi) {
        $ping_validi = [];

        // O(n)
        foreach ($ping_grezzi as $ping) {
            if ($ping > 0) {
                $ping_validi[] = $ping;
            }
        }

        return $ping_validi;
    }

    /*
    calcola_tempo_medio_ accetta un array di interi e restituisce un double (2 decimali)
    */
    function calcola_tempo_medio($ping_validi) {
        $somma = 0;
        /*
        Non uso count() perché diventa complessità O(2n) (doppia iterazione)
        stessa cosa a livello matematico/computazionale (log(n) ~ log(2n)), ma non a livello di server
        */
        $count = 0;
        $media = 0;

        foreach($ping_validi as $ping) {
            $somma += $ping;
            $count++;
        }

        $media = $somma / $count;

        return round($media, 2);
    }

    /*
    calcola_min_max accetta un array di interi e due interi per riferimento; non restituisce nulla
    */
    function calcola_min_max($ping_validi, &$min, &$max) {
        $min = $ping_validi[0];
        $max = $ping_validi[0];

        foreach ($ping_validi as $ping) {
            if ($ping > $max) $max = $ping;
            elseif ($ping < $min) $min = $ping;
        }
    }


    $ping_grezzi = [45, 120, -1, 32, 210, 85, -1, 18, 95, 310, 45, 60, -1, 150, 28, 240, 18, 72];
    array_push($ping_grezzi, 55, 190, 12);

    $pacchetti_persi = conta_pacchetti_persi($ping_grezzi);
    $ping_validi = pacchetti_validi($ping_grezzi);

    $tempo_medio = calcola_tempo_medio($ping_validi);
    $minimo = 0;
    $massimo = 0;
    calcola_min_max($ping_validi, $minimo, $massimo);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Telemetria - Correzione </title>
</head>
<body>
    <!-- Visualizzazione dei dati -> FRONTEND -->
    <ul>
        <li> Totale rilevazioni:    <?= count($ping_grezzi);?>  </li>
        <li> Pacchetti validi:      <?= count($ping_validi);?>  </li>
        <li> Pacchetti persi:       <?= $pacchetti_persi;   ?>  </li>
        <li> Media:                 <?= $tempo_medio;       ?>  </li>
        <li> Minimo:                <?= $minimo;            ?>  </li>
        <li> Massimo:               <?= $massimo;           ?>  </li>
    </ul>

    <table>
        <thead>
            <tr>
                <th> #          </th>
                <th> Ping (ms)  </th>
                <th> Stato      </th>
            </tr>
        </thead>

        <tbody>
            <?php for($i = 0; $i < count($ping_validi); $i++): ?>
                <tr>
                    <td> <?= $i + 1 ?> </td>
                    <td> <?= $ping_validi[$i] ?> </td>
                    <td> <?= $ping_validi[$i] >= 150 ? "CRITICO" : "NORMALE"; ?> </td>
                </tr>
            <?php endfor; ?>
        </tbody>
    </table>
</body>
</html>