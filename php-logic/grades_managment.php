<?php
/**Creare un sistema che gestisca gli studenti e i loro voti, permettendo di:

Aggiungere nuovi studenti

Assegnare voti a ciascun studente

Calcolare la media dei voti per ogni studente

Determinare se lo studente è "Promosso" o "Bocciato" in base alla media

Requisiti:
Struttura Dati: Utilizzare un array multidimensionale per memorizzare gli studenti e i loro voti.

Funzioni:

aggiungiStudente($nome): Aggiunge un nuovo studente all'elenco.

assegnaVoti($nome, $voti): Assegna una lista di voti a uno studente esistente.

calcolaMedia($nome): Calcola la media dei voti di uno studente.

verificaEsito($nome): Determina se lo studente è "Promosso" o "Bocciato". */

function newStudents(string $name){
    global $strudents;
    return $strudents = ["$name" => []];
}

function addGrades(string $name, float ...$grades) {
    global $students;

    foreach($grades as $grade) {
        $strudents[$name] = $grade;
    }
    
    return $strudents;
}

function calculateAvarage(string $name) {
    global $students;

    return array_sum($students[$name]) / count($students[$name]);
}

function checkResult(float $avarage) {
    return $avarage < 6 ? false : true;
}

$name = 'Luca';

$strudents[] = newStudents($name);
$students[$name] = addGrades($name, 2,3,4);
$result = calculateAvarage($name);

if(checkResult($result)){
    echo 'Studente promsso';
} else {
    echo 'Studente bocciato';
}