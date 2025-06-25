<?php

/**Esercizio: Verifica della Complessità della Password
Descrizione:
Scrivi un programma PHP che verifichi se una password è abbastanza sicura. Una password è considerata sicura se:

Ha almeno 8 caratteri.

Contiene almeno una lettera maiuscola.

Contiene almeno una lettera minuscola.

Contiene almeno un numero.

Contiene almeno un carattere speciale (come @, #, $, etc.).

Il programma deve chiedere all'utente di inserire una password e poi dirgli se la password è sicura o meno.
Se la password non è sicura, il programma deve spiegare quale criterio non è stato rispettato. */

function passwordSecurity($password)
{
    if (strlen($password) < 8) {
        return 'Password deve avere almeno 8 caratteri';
    }

    if (!preg_match('/[A-Z]/', $password) || !preg_match('/[a-z]/', $password)) {
        return 'La password deve contenere almeno una maiuscola ed una minuscola';
    }

    if (!preg_match('/[0-9]/', $password)) {
        return 'La password deve contenere almeno un numero';
    }

    if (!preg_match('/[\'^£$%&*()}{@#?><>,|=_+-]/', $password)) {
        return 'La password deve contenere almeno un carattere speciale';
    }

    return 'Password sicura';
}

$security = passwordSecurity('CiAo99-^');

echo $security;
