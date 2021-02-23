<?php
abstract class Animal
{
    static $amount = 0;

    abstract function __construct();
    abstract function getProduct();
    public function getClass()
    {
        return get_class($this);
    }
}


class Cow extends Animal
{
    function __construct()
    {
        $this->id = ++parent::$amount;
    }
    function getProduct()
    {
        return rand(8, 12);
    }
}

class Chicken extends Animal
{
    function __construct()
    {
        $this->id = ++parent::$amount;
    }
    function getProduct()
    {
        return rand(0, 1);
    }
}

class Farm
{
    private $animals = [];

    public function addCow($amount = 1)
    {
        for ($i = 0; $i < $amount; $i++) {
            $this->animals[] = new Cow();
        }
    }
    public function addChicken($amount = 1)
    {
        for ($i = 0; $i < $amount; $i++) {
            $this->animals[] = new Chicken();
        }
    }
    public function collectResources()
    {
        $milk = $eggs = 0;
        foreach ($this->animals as $value) {
            switch ($value->getClass()) {
                case "Cow":
                    $milk += $value->getProduct();
                    break;
                case "Chicken":
                    $eggs += $value->getProduct();
                    break;
            }
        }
        return ['milk' => $milk, 'eggs' => $eggs];
    }
}

$farm = new Farm();
$farm->addCow(10);
$farm->addChicken(20);
$resources = $farm->collectResources();
echo "Собрано {$resources['milk']} литров молока и {$resources['eggs']} яиц";
