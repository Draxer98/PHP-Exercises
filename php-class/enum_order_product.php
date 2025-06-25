<?php

/**Requisiti:

Creazione di un Enum

Crea un enum denominato OrderStatus con i seguenti stati:

Pending
Processing
Shipped
Delivered
Cancelled

Classe Order:

Crea una classe Order con le seguenti proprietà:

id (intero)
customerName (stringa)
status (di tipo OrderStatus)
Costruttore per inizializzare i campi.

Metodo updateStatus(OrderStatus $newStatus) per aggiornare lo stato dell’ordine.
Metodo __toString() che restituisce una rappresentazione leggibile dell’ordine.

Script principale:

Crea almeno 3 ordini diversi con stati differenti.
Mostra a video tutti gli ordini.
Aggiorna lo stato di uno degli ordini e mostra nuovamente il suo stato aggiornato.

Obiettivo Bonus (facoltativo):

Crea un metodo statico in OrderStatus che restituisce una descrizione testuale per ogni stato (es: "L'ordine è stato spedito" per Shipped).
Impedisci di passare da Delivered a qualunque altro stato (una volta consegnato, non si può cambiare più). */

enum OrderStatus: string
{
    case PENDING = 'Pending';
    case PROCESSING = 'Processing';
    case SHIPPED = 'Shipped';
    case DELIVERED = 'Delivered';
    case CANCELLED = 'Cancelled';

    public function getDescription(): string
    {
        return match ($this) {
            self::PENDING => 'The order is pending.',
            self::PROCESSING => 'The order is being processed.',
            self::SHIPPED => 'The order has been shipped.',
            self::DELIVERED => 'The order has been delivered.',
            self::CANCELLED => 'The order has been canceled.'
        };
    }
}

class Order
{
    private int $id;
    private string $custumerName;
    private OrderStatus $status;

    public function __construct(int $id, string $custumerName, OrderStatus $status)
    {
        $this->id = $id;
        $this->custumerName = $custumerName;
        $this->status = $status;
    }

    public function updateStatus(OrderStatus $newStatus)
    {
        if ($this->status === OrderStatus::DELIVERED) {
            echo "It is not possible to modify the order #{$this->id}: already delivered.\n";
            return;
        }
        $this->status = $newStatus;
        echo "Status updated for order #{$this->id} to {$this->status->value} ";
    }

    public function __toString()
    {
        return "ID ORDER: {$this->id}, CUSTOMER NAME: {$this->custumerName}, STATUS: {$this->status->value} - {$this->status->getDescription()}";
    }
}


$order1 = new Order(238748237, 'Sara', OrderStatus::PENDING);
$order2 = new Order(5739015, 'Carlo', OrderStatus::PROCESSING);
$order3 = new Order(1029412049, 'Luigi', OrderStatus::SHIPPED);

echo $order1 . PHP_EOL;
echo $order2 . PHP_EOL;
echo $order3 . PHP_EOL;


$order1->updateStatus(OrderStatus::DELIVERED);
echo $order1 . PHP_EOL;

$order1->updateStatus(OrderStatus::PROCESSING);