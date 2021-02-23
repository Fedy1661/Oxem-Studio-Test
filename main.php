<?php
class Farm
{
    private $animals = array();

    private $chars = "qazxswedcvfrtgbnhyujmkiolp1234567890QAZXSWEDCVFRTGBNHYUJMKIOLP";
    private $max_id = 6;

    public function add_animal($type, $amount_animals = 1, $range = null)
    {
        if (array_key_exists($type, $this->animals)) {
            $ids = $this->animals[$type]['ids'];
            $this->animals[$type]['ids'] =
                array_merge($ids, $this->get_id($amount_animals));
        } else {
            $this->animals[$type] = [
                'ids' => $this->get_id($amount_animals),
                'range' => $range,
                'collected' => 0
            ];
        }
    }

    public function collect_products()
    {
        $total_products = array();
        foreach ($this->animals as $key => $value) {
            $amount = count($value['ids']);
            $products = $value['collected'];
            $range = $value['range'];
            for ($i = 0; $i < $amount; $i++) {
                $products += rand($range[0], $range[1]);
            }
            $total_products[$key] = $products;
            $this->animals[$key]['collected'] = $products;
        }

        return $total_products;
    }

    private function get_id($amount = 1)
    {
        $ids = [];
        for ($i = 0; $i < $amount; $i++) {
            $id = "";
            for ($j = 0; $j < $this->max_id; $j++) {
                $id .= $this->chars[rand(0, 61)];
            }
            array_push($ids, $id);
        }
        return $ids;
    }
}

$farm = new Farm();
$farm->add_animal('cow', 10, [8, 12]);
$farm->add_animal('chicken', 20, [0, 1]);
$products = $farm->collect_products();
echo "Собрано {$products['cow']} литров молока и {$products['chicken']} яиц";