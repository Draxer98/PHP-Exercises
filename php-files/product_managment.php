<?php

/**Gestione di un elenco di prodotti

Descrizione:
Crea uno script PHP che gestisca un semplice inventario di prodotti. Il programma dovrà permettere di:

Aggiungere nuovi prodotti (nome, prezzo).

Visualizzare l'elenco dei prodotti.

Calcolare e mostrare il prezzo totale dell'inventario.

Verificare se esiste un prodotto specifico nell'inventario.*/

$products = [];

function add_product($name, $price)
{
    global $products;
    $products[] = ['name' => $name, 'price' => $price];
}

unset($name, $price);

function view_products()
{
    global $products;

    foreach ($products as $product) {
        echo 'NAME: ' . $product['name'] . " - PRICE: " . $product['price'] . "<br>";
    }
}

function totalPriceProducts()
{
    global $products;
    $sum = 0;
    foreach ($products as $product) {
        $sum += $product['price'];
    }

    return $sum;
}

function searchProduct($search)
{
    global $products;
    foreach ($products as $product) {
        if (array_search($search, $product)) {
            return true;
        }
    }
    return false;
}

unset($name, $price);

add_product('smartphone', 500);
add_product('laptop', 1200);
view_products();
echo totalPriceProducts();

if (searchProduct('laptop')) {
    echo 'Il prodotto cercato esiste';
} else {
    echo 'Il prodotto cercato non esiste';
}
