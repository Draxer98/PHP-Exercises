<?php

/**Obiettivo dell'esercizio:
Creare una semplice applicazione di gestione di una libreria. 
Dovrai implementare delle classi che rappresentano libri, una libreria e fornire metodi per aggiungere, rimuovere e ricercare libri.

Consegna dell'esercizio:

Classi da creare
1. Classe Book

Proprietà:

title (string)
author (string)
year (int)

Metodo:

__construct(string $title, string $author, int $year)
getSummary();

2. Classe Library

Proprietà:

books (array di oggetti Book)

Metodi:

addBook(Book $book)
removeBook(string $title)
findBooksByAuthor(string $author) → ritorna un array di libri scritti da quell'autore
listBooks()*/

class Book
{
    private string $title;
    private string $author;
    private int $year;

    public function __construct(string $title, string $author, int $year)
    {
        $this->title = $title;
        $this->author = $author;
        $this->year = $year;
    }

    public function getTitle()
    {
        return $this->title;
    }

    private function setTitle(string $title)
    {
        $this->title = $title;
    }

    public function getAuthor()
    {
        return $this->author;
    }

    private function setAuthor(string $author)
    {
        $this->author = $author;
    }

    public function getYear()
    {
        return $this->year;
    }

    private function setYear(int $year)
    {
        $this->year = $year;
    }

    public function getSummary()
    {
        return "Title: " . $this->title . ", Author: " . $this->author . ", Year: " . $this->year;
    }
}

class Library
{
    private array $books;

    public function __construct()
    {
        $this->books = [];
    }

    public function getBook()
    {
        return $this->books;
    }

    private function setBook(Book $book)
    {
        $this->books[] = $book;
    }

    public function addBook(Book $book)
    {
        $this->books[] = $book;
    }

    public function removeBook(string $title)
    {
        foreach ($this->books as $i => $book) {
            if (strtolower($book->getTitle()) === strtolower($title)) {
                unset($this->books[$i]);
            }
        }
        $this->books = array_values($this->books);
    }

    public function findBooksByAuthor(string $authorSearch)
    {
        $authors = [];

        foreach ($this->books as $i => $book) {
            if (strtolower($book->getAuthor()) === strtolower($authorSearch)) {
                $authors[] = $book;
            }
        }

        return $authors;
    }

    public function listBook()
    {
        if (!empty($this->books)) {
            foreach ($this->books as $book) {
                echo $book->getSummary() . PHP_EOL;
            }
        } else {
            echo 'The library is closed/empty';
        }
    }
}

$book = new Book('Giungla', 'Giovanni', 2023);

$library = new Library();
$library->addBook($book);
//$library->removeBook('Giungla');
$authors = $library->findBooksByAuthor('Giovanni');
if (empty($authors)) {
    echo "Author not found\n";
} else {
    foreach ($authors as $authorBook) {
        echo $authorBook->getSummary() . PHP_EOL;
    }
}
$library->listBook();