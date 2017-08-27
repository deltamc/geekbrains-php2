<?php

class Cart
{
    /**
     * Содержание корзины, массив
     * [productId]['quantity'] - количество
     * [productId]['price'] - цена
     * [productId]['img'] - превью
     * [productId]['name'] - Название товара
     *
     * @var array
     */
    private $cart = array();
    /**
     * Сумма корзины
     * @var float $sum
     */
    private $sum;
    /**
     * Количество товаров в корзине
     * @var int $Quantity
     */
    private $quantity;

    private $sessionKey;

    function __construct($sessionKey)
    {
        $this->cart = array();
        $this->sessionKey = $sessionKey;


        if(isset($_SESSION[$sessionKey])) {
            $this->cart = $_SESSION[$sessionKey];
        }

        $this->upData();
    }

    /**
     * сумма корзины
     * @return float
     */
    public function getSum()
    {
        return $this->sum;
    }

    /**
     * количество товаров в корзине
     * @return int
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Обновляем сумму и количество
     */
    private function upData()
    {

        $sum = 0;
        $quantity = 0;

        foreach ($this->cart as $productId => $value) {

            $quantity += (int)  $value['quantity'];

            $sum      += (float)  $value['price'] * (int) $value['quantity'];
        }

        $this->sum = $sum;
        $this->quantity = $quantity;


    }

    /**
     * Метод добавляет или обнвляет товар в корзине
     * @param $productId
     * @param $name
     * @param $quantity
     * @param $price
     * @param $img
     */
    public function addOrUpdate($productId, $name, $quantity, $price, $img)
    {
        if($this->isCart($productId)) {
            $quantity = $this->cart[$productId]['quantity'] + $quantity;
        }


        $this->cart[$productId] = array(
            'quantity' => (int) $quantity,
            'price'    => (float) $price,
            'name'     => htmlspecialchars($name),
            'img'      => htmlspecialchars($img),
            'sum'     => (int) $quantity * (float) $price
        );

        $this->upData();

        $_SESSION[$this->sessionKey] = $this->cart;


    }

    /**
     * Метод обновляет кол-во
     * @param $productId
     * @param $quantity
     */
    public function updateQuantity($productId, $quantity)
    {
        $quantity  = (int) $quantity;
        $productId = (int) $productId;


        if(!$this->isCart($productId)) {
            return;
        }

        $price = $this->cart[$productId]['price'];

        $this->cart[$productId]['quantity'] =  (int) $quantity;
        $this->cart[$productId]['sum'] = (int) $quantity * (float) $price;


        $this->upData();

        $_SESSION[$this->sessionKey] = $this->cart;


    }

    /**
     * метод удаляет товар из корзины
     * @param $productId
     */
    public function delete($productId)
    {
        unset($this->cart[$productId]);
        $this->upData();
        $_SESSION[$this->sessionKey] = $this->cart;
    }

    /**
     * Метод очищает корзину
     */
    public function clear()
    {
        $this->cart = array();
        $this->upData();
        $_SESSION[$this->sessionKey] = $this->cart;
    }

    /**
     * Метод возвращает содержимое корзины
     * @return array
     */
    public function get()
    {
        return $this->cart;
    }

    /**
     * метод проверяет пустая ли корзина
     * @return bool
     */
    public function isEmpty()
    {
        return empty($this->cart);
    }


    /**
     * Метод проверяет есть ли товар в корзине
     * @param $productId
     * @return bool
     */
    public function isCart($productId)
    {
        if (isset($this->cart[$productId])) {
            return true;
        }

        return false;
    }
}