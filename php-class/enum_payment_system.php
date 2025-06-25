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

enum PaymentMethod {
    case CASH;
    case CREDIT_CARD;
    case BANK_TRANSFER;
    case PAYPAL;

    public function paymentMethod(): string {
        return match($this) {
            self::CASH => 'Paid with cash.',
            self::CREDIT_CARD => 'Paid with credit card.',
            self::BANK_TRANSFER => 'Paid with bank transfer.',
            self::PAYPAL => 'Paid with paypal'
        };
    }
}

class Invoice {
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

    
}