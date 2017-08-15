<?php
//Придумать класс, который описывает любую
// сущность из предметной области интернет-магазинов:
// продукт, ценник, посылка и т.п.

/**
 * Class Coupon
 * класс-сущность купона с фиксированным номиналом.
 */
class CouponFix{
    //Номинал
    protected $discount = '2000';
    //срок действия
    protected $validity = '15.09.2018 15:00';
    //уникальный код
    protected $code = '878979645648';

    /**
     * Публичный метод возвращает сумму заказа с учетом скидки.
     *
     * @param $sum - сумма заказа
     * @param $cod - код вводимый пользователем
     * @return float - сумма скидки
     */
    public function getSumOrder($sum, $cod)
    {
        if (!$this->isValid($cod, $sum)) {
            return $sum;
        }

        //рассчитываем скидку
        return $this->calculate($sum);

    }

    /**
     * метод рассчитывает скидку
     * @param $sum - сумма заказа
     * @return mixed -
     */
    protected function calculate($sum){
        return $sum - $this->discount;
    }

    /**
     * метод проверяет действителен ли купон
     * @param $cod
     * @param $sum
     * @return bool
     */
    protected function isValid($cod, $sum){
        //если код купона не совпадает
        if ($cod !== $this->code) {
            return false;
        }

        //если купон истек
        if (time() > strtotime($this->validity)) {
            return false;
        }

        return true;
    }
}

/**
 * Class CouponPercent
 * купон на 20% действует для заказов от 1000р.
 */
class CouponPercent extends CouponFix
{
    //Номинал
    protected $discount = '20';
    //минимальная сумма заказа
    protected $minSum = 1000;


    /**
     * метод рассчитывает скидку
     * @param $sum - сумма заказа
     * @return mixed -
     */
    protected function calculate($sum){
        return $sum - $sum * $this->discount / 100;
    }

    /**
     * метод проверяет действителен ли купон
     * @param $cod
     * @param $sum
     * @return bool
     */
    protected function isValid($cod, $sum)
    {

        if (!parent::isValid($cod, $sum)) {
            return false;
        }

        if ($sum < $this->minSum) {
           return false;
        }


        return true;
    }


}