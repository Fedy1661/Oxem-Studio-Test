<?php
abstract class Animal
{
    static $amount = 0;

    public $id;

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
    public function addCow()
    {
        return new Cow();
    }
    public function addChicken()
    {
        return new Chicken();
    }
}

$farm = new Farm();
$allAnimals = [];
for ($i = 0; $i < 20; $i++) {
    $allAnimals[] = $farm->addChicken();
}
for ($i = 0; $i < 10; $i++) {
    $allAnimals[] = $farm->addCow();
}

$liters = $eggs = 0;
foreach ($allAnimals as $value) {
    switch ($value->getClass()) {
        case "Cow":
            $liters += $value->getProduct();
            break;
        case "Chicken":
            $eggs += $value->getProduct();
            break;
    }
}
echo "Собрано {$liters} литров молока и {$eggs} яиц";
