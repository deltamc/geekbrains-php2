<?php
abstract class Product
{
    private $price;

    public function setPrice($price)
    {
        $this->price = $price;
    }

    public function getPrice()
    {
        return $this->price;
    }

    abstract public function calculation();

    public function income()
    {
        return $this->calculation() * 0.2;
    }

}


class ProductWeight extends Product
{
    private $weight;

    public function setWeight($weight)
    {
        $this->weight = $weight;
    }

    public function getWeight()
    {
        return $this->weight;
    }

    public function calculation()
    {
        return $this->getPrice() * $this->getWeight();
    }

}

class ProductDigital extends Product
{
    public function calculation()
    {
        return $this->getPrice()/2;
    }
}

class ProductStandard extends Product
{
    public function calculation()
    {
        return $this->getPrice();
    }
}