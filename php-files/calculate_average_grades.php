<?php
/**Scrivi un programma PHP che permetta di:

Inserire una serie di voti (numeri da 0 a 10) per uno studente.

Calcolare la media dei voti.

Verificare se la media è sufficiente (maggiore o uguale a 6 per essere sufficiente).

Visualizzare il risultato:

Se la media è sufficiente, visualizzare il messaggio: "Studente promosso con [media]".

Se la media è insufficiente, visualizzare il messaggio: "Studente bocciato con [media]".*/

function calculate_avarage_grades(float ...$numbers) {
    foreach($numbers as $number){
        if($number < 0 || $number > 10) {
            return null;
        }
    }

    $avarage = array_sum($numbers) / count($numbers);

    return $avarage >= 6 ? "Studente promosso con $avarage di media" : "Studente bocciato con $avarage di media";
}

echo calculate_avarage_grades(6,7,8);