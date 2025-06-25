<?php

/**Definisci una classe astratta chiamata Animale, che contenga:

una proprietà per il nome dell’animale;

un costruttore per inizializzare il nome;

un metodo astratto doSound() che ogni sottoclasse dovrà implementare;

un metodo concreto description() che restituisca una stringa con il nome dell’animale.

Crea almeno tre classi concrete che estendano la classe Animale (ad esempio: Cane, Gatto, Mucca).

Ogni classe deve implementare il metodo doSound() restituendo una stringa diversa (es. “Bau!”, “Miao!”, “Muuu!”).

Nel codice principale, crea un array di oggetti appartenenti alle varie classi concrete e usa un ciclo per:

stampare la descrizione dell’animale;

farlo “parlare” invocando doSound(). */


abstract class Animals
{
    private string $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    abstract public function doSound();

    public function description()
    {
        return "Name: $this->name";
    }
}

class Dog extends Animals
{
    public function __construct($name)
    {
        parent::__construct($name);
    }

    public function doSound()
    {
        return 'BAU!';
    }
}

class Cat extends Animals
{
    public function __construct($name)
    {
        parent::__construct($name);
    }

    public function doSound()
    {
        return 'MIAO!';
    }
}

class Cow extends Animals
{
    public function __construct($name)
    {
        parent::__construct($name);
    }

    public function doSound()
    {
        return 'MOO!';
    }
}

class Sheep extends Animals
{
    public function __construct($name)
    {
        parent::__construct($name);
    }

    public function doSound()
    {
        return 'BE-E!';
    }
}

class Bird extends Animals
{
    public function __construct($name)
    {
        parent::__construct($name);
    }

    public function doSound()
    {
        return 'CHIP-CHIP!';
    }
}

$animals = [
    new Dog('Fuffi'),
    new Cat('Sergio'),
    new Cow('Lola'),
    new Sheep('Kelly'),
    new Bird('Rio')
];

foreach ($animals as $animal) {
    echo $animal->description() . " says " . $animal->doSound() . PHP_EOL;
}
