<?php

class ShopProduct
{
    public function __construct(        public $title,
                                        public $produserFirstName = '',
                                        public $produserMainName = '',
                                        public $price = 0
    )    {

    }

    public function getProducer() {
        //return $this->produserFirstName . " " . $this->produserMainName;
        return $this->title . " " . $this->price;
    }

}

//$product1 = new ShopProduct("Собачье сердце", "Михайл", "Булгаков", 5.99);
$product1 = new ShopProduct(
    price: 0.7,
    title: "Католог книг"
);
print "За : {$product1->getProducer()}\n";

