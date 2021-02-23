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
    public $milk = 0;
    public $eggs = 0;

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
    public function collectResources(){
        foreach ($this->animals as $value) {
            switch ($value->getClass()) {
                case "Cow":
                    $this->milk += $value->getProduct();
                    break;
                case "Chicken":
                    $this->eggs += $value->getProduct();
                    break;
            }
        }
    }
}

$farm = new Farm();
$farm->addCow(10);
$farm->addChicken(20);
$farm->collectResources();
echo "Собрано {$farm->milk} литров молока и {$farm->eggs} яиц";
