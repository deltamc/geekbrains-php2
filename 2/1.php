<?php
abstract class Product
{
    protected $price;

    public function setPrice($price)
    {
        $this->price = $price;
    }

    abstract public function calculation();

    public function income()
    {
        return $this->calculation() * 0.2;
    }

}


class ProductWeight extends Product
{
    protected $weight;

    public function setWeight($weight)
    {
        $this->weight = $weight;
    }

    public function calculation()
    {
        return $this->price * $this->weight;
    }

}

class ProductDigital extends Product
{
    public function calculation()
    {
        return $this->price/2;
    }
}

class ProductStandard extends Product
{
    public function calculation()
    {
        return $this->price;
    }
}