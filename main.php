<?php

abstract class Animals
{
    public $amount;
    public $animals = array();

    private $chars = "qazxswedcvfrtgbnhyujmkiolp1234567890QAZXSWEDCVFRTGBNHYUJMKIOLP";
    private $max_id = 6;

    function __construct($amount)
    {
        $this->amount = $amount;
        for ($i = 0; $i < $amount; $i++) {
            array_push($this->animals, $this->get_id());
        }
    }

    private function get_id()
    {
        $password = "";
        for ($i = 0; $i < $this->max_id; $i++) {
            $password .= $this->chars[rand(0, 61)];
        }
        return $password;
    }
}

class Cows extends Animals
{
    public function get_milk()
    {
        $liters = 0;
        for ($i = 0; $i < $this->amount; $i++) {
            $liters += rand(8, 12);
        }
        return $liters;
    }
}

class Chickens extends Animals
{
    public function get_eggs()
    {
        $eggs = 0;
        for ($i = 0; $i < $this->amount; $i++) {
            $eggs += rand(0, 1);
        }
        return $eggs;
    }
}


$cows = new Cows(10);
$chickens = new Chickens(20);
$liters = $cows->get_milk();
$eggs = $chickens->get_eggs();
echo "Собрано {$liters} литров и {$eggs} яиц.";
