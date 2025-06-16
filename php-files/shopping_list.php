<?php
/**Scrivi un programma PHP che permetta di gestire una lista della spesa con le seguenti funzionalità:

Aggiungere un elemento alla lista:
L'utente deve essere in grado di aggiungere un prodotto alla lista.

Rimuovere un elemento dalla lista:
L'utente deve poter rimuovere un prodotto dalla lista.

Visualizzare la lista:
Mostrare tutti gli elementi presenti nella lista della spesa.

Contare il numero di elementi:
Mostrare il numero totale di articoli presenti nella lista della spesa.
 */

$lists = [];

function add_list(string $products) {
    global $lists;
    return $lists[] = $products; 
}

unset($products);

function remove_product(string $product) {
    global $lists;
    $key = array_search($product, $lists);
    if($key){
       unset($lists[$key]);
       return true;
    }
}

unset($product);

function view_product(){
    global $lists;

    foreach($lists as $list){
        echo "$list";
    }
}

function count_product(){
    global $lists;

    print_r(count($lists));
}

add_list('Pane');
add_list('Pasta');

if(remove_product('Pasta')){
    echo "Il prodotto è stato rimosso <br>";
} else {
    echo "Il prodotto non è nella lista <br>";
}

view_product();

echo "<br>";

count_product();