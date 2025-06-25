<?php

/**Requisiti
Creazione di un Enum:

Crea un enum denominato PaymentMethod con i seguenti metodi:

CASH
CREDIT_CARD
BANK_TRANSFER
PAYPAL

Classe Invoice:

Proprietà:

invoiceNumber (stringa)
customerName (stringa)
amount (float)
paymentMethod (di tipo PaymentMethod)

Metodi:

Costruttore per inizializzare i campi.
Metodo pay() che stampa un messaggio personalizzato in base al metodo di pagamento.
Metodo __toString() che restituisce una stringa leggibile della fattura.

Script principale:

Crea almeno 3 fatture con metodi di pagamento diversi.
Mostrale a video.
Esegui il metodo pay() per ognuna, mostrando messaggi specifici (es. "Pagamento in contanti ricevuto").

Obiettivo Bonus:

Aggiungi un metodo statico in PaymentMethod che restituisce una commissione percentuale applicata al pagamento:

CASH: 0%
CREDIT_CARD: 2%
BANK_TRANSFER: 1.5%
PAYPAL: 3%

Calcola e mostra la commissione in euro durante il pagamento. */

enum PaymentMethod: string
{
    case CASH = 'Cash';
    case CREDIT_CARD = 'credit card';
    case BANK_TRANSFER = 'bank transfer';
    case PAYPAL = 'paypal';

    public function getMessage(): string
    {
        return match ($this) {
            self::CASH => 'Paid with cash.',
            self::CREDIT_CARD => 'Paid with credit card.',
            self::BANK_TRANSFER => 'Paid with bank transfer.',
            self::PAYPAL => 'Paid with paypal'
        };
    }

    public function getCommission(): float
    {
        return match ($this) {
            self::CASH => 0.0,
            self::CREDIT_CARD => 2.0,
            self::BANK_TRANSFER => 1.5,
            self::PAYPAL => 3.0
        };
    }
}

class Invoice
{
    private string $invoiceNumber;
    private string $customerName;
    private float $amount;
    private PaymentMethod $paymentMethod;

    public function __construct(string $invoiceNumber, string $customerName, float $amount, PaymentMethod $paymentMethod)
    {
        $this->invoiceNumber = $invoiceNumber;
        $this->customerName = $customerName;
        $this->amount = $amount;
        $this->paymentMethod = $paymentMethod;
    }

    public function payCommition() {
        $this->amount = number_format($this->amount += ($this->amount/100) * $this->paymentMethod->getCommission(), 2);
    }

    public function __toString()
    {
        return "NUMBER: {$this->invoiceNumber}, NAME: {$this->customerName}, AMOUNT: {$this->amount}, PAYMENT: {$this->paymentMethod->value} - {$this->paymentMethod->getMessage()}";
    }
}

$payment1 = new Invoice("51273876", "Gianni", 120, PaymentMethod::CASH);
$payment2 = new Invoice("42163583", "Fede", 23.79, PaymentMethod::BANK_TRANSFER);
$payment3 = new Invoice("98249878", "Marta", 65.99, PaymentMethod::CREDIT_CARD);
$payment4 = new Invoice("45786213", "Noemi", 43, PaymentMethod::PAYPAL);

echo $payment1 . PHP_EOL;
echo $payment2 . PHP_EOL;
echo $payment3 . PHP_EOL;
echo $payment4 . PHP_EOL;

$payment2->payCommition();

echo $payment2 . PHP_EOL;