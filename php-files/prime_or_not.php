<?php

/**
 * Si definisce un numero primo un numero che sia divisibile per due numeri, sé stesso e 1.
 * Secondo tale definizione, quindi, il numero 1 non è primo in quanto è divisibile solo per un numero.
 * La funzione deve effettuare le seguenti operazioni, in base al parametro $number passato alla funzione stessa:
 * - se il numero è inferiore a 2, ritorna 0
 * - altrimenti, se il numero non è primo, ritorna -1
 * - altrimenti, ritorna la somma dei numeri da 1 a $number
 *
 * NOTA: è possibile implementare anche altre funzioni di "supporto" oltre a quella di base prevista dall'esercizio.
 *
 * @param int $number
 * @return int
 */
function prime_or_not($number)
{
	$contatore = 0;
	$result = 0;

	if ($number < 2) {
		return 0;
	}

	for ($i = $number; $i > 1; $i--) {
		if ($number === $i) {
			$contatore++;
		} elseif (($number % $i === 0)) {
			$contatore++;
		}
	}

	if ($contatore === 1) {
		for ($i = 1; $i <= $number; $i++) {
			$result += $i;
		}

		return $result;
	}

	return -1;
}

// TESTCASE, non cancellare né modificare
var_dump(
	prime_or_not(11) === 66,
	prime_or_not(13) === 91,
	prime_or_not(1)  ===  0,
	prime_or_not(0)  ===  0,
	prime_or_not(4)  === -1,
	prime_or_not(12) === -1,
	prime_or_not(17) === 153
);
