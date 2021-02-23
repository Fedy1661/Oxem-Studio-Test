<?php
abstract class Animal
{
    static $amount = 0;

    public function getClass()
    {
        return get_class($this);
    }

    abstract public function __construct($typeAnimal, $range, $typeOfResource);
    abstract public function getProduct();
    abstract public function getTypeOfAnimal();
    abstract public function getTypeOfResource();
}

// abstract class Recource
// {
//     // public $name;
//     // public $range;
//     function __construct()
//     {
//     }
// }

class Farm
{
    private $animals = [];

    public function addAnimal($typeAnimal, $amount = 1, $range, $typeOfResource)
    {
        for ($i = 0; $i < $amount; $i++) {
            $this->animals[] = new class($typeAnimal, $range, $typeOfResource) extends Animal
            {
                public $range;

                function __construct($typeAnimal, $range, $typeOfResource)
                {
                    $this->typeAnimal = $typeAnimal;
                    $this->range = $range;
                    $this->typeOfResource = $typeOfResource;
                    $this->id = ++parent::$amount;
                }
                public function getProduct()
                {
                    return rand($this->range[0], $this->range[1]);
                }
                public function getTypeOfAnimal()
                {
                    return $this->typeAnimal;
                }
                public function getTypeOfResource()
                {
                    return $this->typeOfResource;
                }
            };
        }
    }

    // public function addResource($name, $range){
    //     $this->resources[] = new class extends Recource{

    //     }
    // }

    public function collectResources()
    {
        $resources = [];
        foreach ($this->animals as $value) {
            if (array_key_exists($value->getTypeOfResource(), $resources)) {
                $resources[$value->getTypeOfResource()] += $value->getProduct();
            } else {
                $resources[$value->getTypeOfResource()] = $value->getProduct();
            }
        }
        return $resources;
    }
}

$farm = new Farm();
$farm->addAnimal('cow', 10, [8, 12], 'milk');
$farm->addAnimal('chicken', 20, [0, 1], 'eggs');
$products = $farm->collectResources();

echo "Собрано {$products['milk']} литров молока и {$products['eggs']} яиц";
