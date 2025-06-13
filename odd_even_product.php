<?php

/**
 * Calcola il prodotto dei numeri e ritorna un risultato in base al prodotto.
 *
 * Data la lista di numeri interi (rappresentata dal parametro $numbers), la funzione deve eseguire le seguenti operazioni:
 * - calcola il prodotto dei numeri forniti
 * - se il prodotto è dispari, ritorna 0
 * - altrimenti, ritorna la somma dei singoli numeri
 * 
 * @param int[] $numbers
 * @return int
 */
function odd_even_product(array $numbers)
{
	return (array_product($numbers) % 2 !== 0) ? 0 : array_sum($numbers);
}

// TESTCASE, non cancellare né modificare
var_dump(
	odd_even_product([-1, -3, -5, -7, -9]) ===   0,
	odd_even_product([5, 7, 9, -2])        ===  19,
	odd_even_product([1, 3, 5, 7, 9, 0])   ===  25,
	odd_even_product([-2, -4, -6])         === -12,
	odd_even_product([0, 5, 5])            ===  10
);
