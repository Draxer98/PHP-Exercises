<?php

/**Verifica delle Combinazioni di Un Sacchetto di Numeri
Descrizione:
Supponiamo di avere un sacchetto con n numeri (può essere qualsiasi valore) e vogliamo verificare se ci sono combinazioni che soddisfano determinate condizioni.
L'esercizio si concentrerà su un piccolo sacchetto con numeri e verificherà alcune combinazioni logiche tra di essi.

Obiettivo: Scrivere uno script PHP che:

Prende una lista di numeri.

Trova tutte le combinazioni di due numeri che soddisfano una certa condizione (ad esempio, la loro somma deve essere pari, o deve essere maggiore di un valore specificato).

Stampa tutte le combinazioni valide con il risultato della condizione.

Esempio di Condizioni:

La somma di due numeri deve essere pari.

La somma di due numeri deve essere maggiore di un valore specificato (ad esempio, 10).*/

function combinationsEven(int ...$numbers)
{
    $evenSum = [];
    for ($i = 0; $i < count($numbers); $i++) {
        for ($j = $i + 1; $j < count($numbers); $j++) {
            $sum = ($numbers[$i] + $numbers[$j]);
            if ($sum % 2 === 0) {
                $evenSum[] = [$numbers[$i], $numbers[$j], $sum];
            }
        }
    }

    return $evenSum;
}

unset($sum, $numbers);

function combinationsParam(int ...$numbers)
{
    $paramSum = [];
    for ($i = 0; $i < count($numbers); $i++) {
        for ($j = $i + 1; $j < count($numbers); $j++) {
            $sum = ($numbers[$i] + $numbers[$j]);
            if ($sum > 10) {
                $paramSum[] = [$numbers[$i], $numbers[$j], $sum];
            }
        }
    }

    return $paramSum;
}

$resultsEven = combinationsEven(2, 6, 4, 8, 5);
$resultsParam = combinationsParam(2, 6, 4, 8, 5);

echo 'COMBINAZIONE PARI' . "\n";
if ($resultsEven !== null) {
    foreach ($resultsEven as $resultEven) {
        echo $resultEven[0] . ' + ' . $resultEven[1] . ' = ' . $resultEven[2] . "\n";
    }
} else {
    echo 'Combinazioni non trovate';
}

echo 'COMBINAZIONI CON PARAMETRI' . "\n";

if ($resultsParam !== null) {
    foreach ($resultsParam as $resultParam) {
        echo $resultParam[0] . ' + ' . $resultParam[1] . ' = ' . $resultParam[2] . "\n";
    }
} else {
    echo 'Combinazioni non trovate';
}
