<?php

/**
 * Ordina le parole di una string in base all'ultima lettera di ciascuna parola.
 *
 * Data la stringa di ingresso (rappresentata dal parametro $sentence), la funzione deve eseguire le seguenti operazioni:
 * - trasforma la stringa in array di parole
 * - ordina le parole in base all'ultima lettera, in minuscolo, in ordine alfabetico
 * - ritorna l'array ordinato
 * 
 * @param string $sentence
 * @return string[]
 */
function sortByLastCharacter(string $sentence)
{
	$strDivided = explode(' ', $sentence);
	usort($strDivided, function ($s1, $s2) {
		return strtolower($s1[-1]) <=> strtolower($s2[-1]);
	});
//	var_dump($strDivided);
		
	/*
	$n = count($strDivided);
	for ($i = 0; $i < $n - 1; $i++) {
		for ($j = 0; $j < $n - $i - 1; $j++) {
			$lastCharA = $strDivided[$j][strlen($strDivided[$j]) - 1];
			$lastCharB = $strDivided[$j + 1][strlen($strDivided[$j + 1]) - 1];
			$lastCharA = strtolower($lastCharA);
			$lastCharB = strtolower($lastCharB);

			var_dump($lastCharA);

			if ($lastCharA > $lastCharB) {
				$temp = $strDivided[$j];
				$strDivided[$j] = $strDivided[$j + 1];
				$strDivided[$j + 1] = $temp;
			}
		}
	}
	*/

	return $strDivided;
}

// TESTCASE, non cancellare né modificare
var_dump(
	sortByLastCharacter("I am never at home on Sundays") === ["home", "I", "am", "on", "never", "Sundays", "at"],
	sortByLastCharacter("Aliquam nec sollicitudin massa") === ["massa", "nec", "Aliquam", "sollicitudin"],
	sortByLastCharacter("Nullam vehicula velit sed quam faucibus efficitur quis eu odio") === ["vehicula", "sed", "Nullam", "quam", "odio", "efficitur", "faucibus", "quis", "velit", "eu"],
	sortByLastCharacter("Vestibulum ullamcorper volutpat velit") === ["Vestibulum", "ullamcorper", "volutpat", "velit"],
	sortByLastCharacter("Pellentesque venenatis vehicula vulputate") === ["vehicula", "Pellentesque", "vulputate", "venenatis"]
);
