<?php
function nazione_per_citta($vet, $citta)
{
    if(isset($vet[$citta])){
        echo "la città: ". $citta . " è in: ".$vet[$citta] . "<hr>";
    }
}
function citta_per_nazione($vet, $nazione)
{
    if ($a = array_search($nazione, $vet)) {
        echo "La capitale della: " . $nazione . " è in: " . $a;
    } else {
        echo "nazione non trovata";
    }
    echo "<hr>";
}
function stampa_tutto($vet)
{
    reset($vet);
    $tmp = current($vet);
    if($tmp){
        echo "$tmp<br>";
        while($tmp = next($vet)){
            echo "$tmp<br>";
        }

    }else{
        echo "array vuoto";
    }
    echo "<hr>";
}

$info = array('Madrid' => 'Spagna', 'Roma' => 'Italia', 'Berlino' => 'Germania', 'Parigi' => 'Francia');
citta_per_nazione($info, 'Regno Unito');
nazione_per_citta($info, 'Roma');
stampa_tutto($info);
?>