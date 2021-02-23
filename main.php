<?php
abstract class Animal
{
    static $amount = 0;

    public function getId()
    {
        $this->id = ++self::$amount;
    }

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
        parent::getId();
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
        parent::getId();
    }
    function getProduct()
    {
        return rand(0, 1);
    }
}

class Farm
{
    private $animals = [];

    public function addAnimal($type, $amount)
    {
        if (
            class_exists($type) and
            filter_var($amount, FILTER_VALIDATE_INT, ["options" => ["min_range" => 1]])
        ) {
            for ($i = 0; $i < $amount; $i++) {
                $this->animals[] = new $type();
            }
        } else {
            echo "Incorrect data.\n";
        }
    }

    public function collectResources()
    {
        $resources = [];
        foreach ($this->animals as $value) {
            $typeOfAnimal = $value->getClass();
            if (array_key_exists($typeOfAnimal, $resources)) {
                $resources[$typeOfAnimal] += $value->getProduct();
            } else {
                $resources[$typeOfAnimal] = $value->getProduct();
            }
        }
        return $resources;
    }
}

$farm = new Farm();
$farm->addAnimal('Cow', 10);
$farm->addAnimal('Chicken', 20);
$resources = $farm->collectResources();
echo "Собрано {$resources['Cow']} литров молока и {$resources['Chicken']} яиц";
