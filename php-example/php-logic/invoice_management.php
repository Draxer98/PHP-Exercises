<?php
/**Calcolatore di Fatture
Crea un programma per la generazione di una fattura. Il programma deve:

Consentire all'utente di inserire il nome del prodotto, la quantità e il prezzo.

Calcolare il totale.

Applicare uno sconto se l'importo supera una certa soglia (es. 100 euro).

Visualizzare la fattura completa. */
$invoices = [];

function addProduct($name, $quantity, $price){
    global $invoices;

    return $invoices[] = [ 'name' => $name, 'quantity' => $quantity, 'price' => $price];
}

function totalProduct(){
    global $invoices;
    $total = 0;

    foreach($invoices as $invoice) {
        $total += ($invoice['quantity'] * $invoice['price']);
    }

    return $total;
}

function viewInvoice($total, $discount = false) {
    global $invoices;
    $name = '';
    $quantity = '';
    $price = '';

    echo 'INVOICE' . "<br><br>";

    foreach($invoices as $invoice) {
        $name = $invoice['name'];
        $quantity = $invoice['quantity'];
        $price = $invoice['price'];
        echo "$quantity $name = $price $" . "<br>";
    }

    echo "<br>" . "TOTAL : $total $";
    if($discount){
        echo "<br>" . "5% discount";
    }
}

function discount($total){
    return $total -= ($total/100) * 5;
}

addProduct('pane', 10, 3);
addProduct('pasta', 20, 4.50);
$total = totalProduct();

if($total > 100) {
    $total = discount($total);
    viewInvoice($total, true);
} else {
    viewInvoice($total);
}

