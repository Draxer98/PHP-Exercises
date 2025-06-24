<?php

/**Requisiti:
1. Classe astratta Prodotto
Crea una classe astratta Prodotto con le seguenti proprietà comuni:

nome (stringa)

prezzo (float)

disponibile (boolean)

E i seguenti metodi:

Metodo costruttore per inizializzare le proprietà

Metodo astratto getDettagli() – ogni sottoclasse deve implementare questo metodo.

Metodo sconto($percentuale) che applica uno sconto sul prezzo.

2. Classi derivate
Crea almeno due classi che estendono Prodotto:

a) Classe Libro
Proprietà aggiuntive:

autore (stringa)

numeroPagine (intero)

b) Classe Videogioco
Proprietà aggiuntive:

piattaforma (stringa)

etàConsigliata (intero)

Implementa in ciascuna classe il metodo getDettagli() per stampare tutte le informazioni del prodotto.

3. Script principale
Nel file principale:

Crea almeno 2 oggetti per ciascuna classe (Libro, Videogioco)

Stampa i dettagli dei prodotti usando getDettagli()

Applica uno sconto ad almeno un prodotto e ristampa i dettagli

(Bonus) – Estensioni opzionali:
Crea una classe Negozio che contiene un array di prodotti.

Aggiungi un metodo stampaCatalogo() che cicla tutti i prodotti e stampa i loro dettagli.

Permetti di filtrare i prodotti disponibili (disponibile == true). */

abstract class Product
{
    private string $name;
    private float $price;
    private bool $isAvailable;

    public function __construct(string $name, float $price)
    {
        $this->name = $name;
        $this->price = $price;
        $this->isAvailable = true;
    }

    abstract public function getDetails();

    public function discount()
    {
        $this->price -= ($this->price / 100) * 5;
    }

    public function getIsAvailable()
    {
        return $this->isAvailable;
    }

    public function setIsAvailable(bool $available)
    {
        $this->isAvailable = $available;
    }

    public function getCommonDetails()
    {
        return "Name: " . $this->name . ", Price: " . $this->price;
    }
}

class Book extends Product
{
    private string $author;
    private int $pageNumber;

    public function __construct(string $name, float $price, string $author, int $pageNumber)
    {
        parent::__construct($name, $price);
        $this->author = $author;
        $this->pageNumber = $pageNumber;
    }

    public function getDetails()
    {
        return parent::getCommonDetails() . ", Author: " . $this->author . ", Pages: " . $this->pageNumber . PHP_EOL;
    }
}

class Videogame extends Product
{
    private string $platform;
    private int $age;

    public function __construct(string $name, float $price, string $platform, int $age)
    {
        parent::__construct($name, $price);
        $this->platform = $platform;
        $this->age = $age;
    }

    public function getDetails()
    {
        return parent::getCommonDetails() . ", Platform: " . $this->platform . ", Age: " . $this->age . '+' . PHP_EOL;
    }
}

class Shop
{
    private array $products;

    public function __construct(Book|Videogame ...$product)
    {
        $this->products = $product;
    }

    public function listProducts(): void
    {
        foreach ($this->products as $product) {
            if ($product->getIsAvailable() === true) {
                echo $product->getDetails();
            }
        }
    }
}

$book1 = new Book("The enemy's attack", 9.50, 'Floriano', 257);
$videogame1 = new Videogame('Fable 4', 79.99, 'Xbox series X', 16);
$videogame1->discount();
$book1->setIsAvailable(false);
$shop = new shop($book1, $videogame1);

$shop->listProducts();
