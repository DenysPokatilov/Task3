<?php
/**
 * Created by PhpStorm.
 * User: Denys
 * Date: 31.03.2018
 * Time: 16:17
 */

class Order
{
    const FIVE_PERCENT = 0.05;
    const TEN_PERCENT = 0.1;
    const FIFTEEN_PERCENT = 0.15;

    const PRODUCTS_PRICE = [
        'a' => 15,
        'b' => 20,
        'c' => 45,
        'd' => 50,
        'e' => 21,
        'f' => 5,
        'g' => 37
    ];

    private $producOrders = [];
    private $discount = 0;

    public function __construct(array $order)
    {
        $this->producOrders = $order;
    }


    public function getDiscount()
    {
        $this->getFivePercent();
        $this->getTenPercent();
        $this->getFifteenPercent();
        return $this->discount;

    }
    private function calculationOfDiscount($percent){
        $totalPrice=0;
        foreach ($this->producOrders as $productName => $productQty) {
            $totalPrice = $totalPrice + self::PRODUCTS_PRICE[$productName] * $productQty;
        }
        $this->discount = $totalPrice * $percent;
    }
    private function getFivePercent()
    {
        if (array_sum($this->producOrders) === 3) {
                $this->calculationOfDiscount(self::FIVE_PERCENT);
        }
    }

    private function getTenPercent()
    {
        if (($this->producOrders['a'] || $this->producOrders['c']) && count($this->producOrders)) {
            $this->calculationOfDiscount(self::TEN_PERCENT);
        }
    }
    private function getFifteenPercent(){


        if (array_sum($this->producOrders)>100){
            $this->calculationOfDiscount(self::FIFTEEN_PERCENT);

        }
    }

}

$order = ['a' => 1, 'd' => 1, 'e' => 5];
$tov = new Order($order);
var_dump($tov->getDiscount());




