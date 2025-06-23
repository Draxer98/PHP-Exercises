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
        $total += $invoice['quantity'] * $invoice['price'];
    }

    return $total;
}

function viewInvoice($total) {
    global $invoices;

    echo 'INVOICE' . "\n";

    foreach($invoices as $invoice) {
        echo "$invoice" . "\n";
    }

    echo "TOTAL : $total";
}

function discount($total){
    return ($total/100) * 5;
}

addProduct('pane', 10, 30);
$total = totalProduct();

if($total > 100) {
    $total = discount($total);
}