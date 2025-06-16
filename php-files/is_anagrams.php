<?php
/**Scrivi un programma PHP che permetta di verificare se due stringhe sono anagrammi. Due parole sono anagrammi se contengono le stesse lettere, ma in ordine diverso.

Funzionalità richieste:

Verifica se le due parole sono anagrammi.

Se le parole sono anagrammi, stampa: "Le parole sono anagrammi."

Se le parole non sono anagrammi, stampa: "Le parole non sono anagrammi." */

function is_anagrams(array $anagrams){
    $cont = 0;
    if(strlen($anagrams[0]) !== strlen($anagrams[1])){
        return null;
    }

    $string1 = str_split($anagrams[0]);
    $string2 = str_split($anagrams[1]);

    sort($string1);
    sort($string2);

    for($i = 0; $i < count($string1); $i++){
        if($string1[$i] === $string2[$i]){
            $cont++;
        }
    }

    return $cont == count($string1) ? "Le parole sono anagrammi" : "Le parole non sono anagrammi";
}

echo is_anagrams(['radar', 'cielo']);