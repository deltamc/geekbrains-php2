<?php

class Good extends Model {
    protected static $table = 'goods';

    protected static function setProperties()
    {
        self::$properties['name'] = [
            'type' => 'varchar',
            'size' => 512
        ];

        self::$properties['price'] = [
            'type' => 'float'
        ];

        self::$properties['description'] = [
            'type' => 'text'
        ];

        self::$properties['category'] = [
            'type' => 'int'
        ];
    }

    public static function getGoods($categoryId)
    {
        return db::getInstance()->Select(
            'SELECT id_category, `name`, price FROM goods WHERE id_category = :category AND status=:status',
            ['status' => Status::Active, 'category' => $categoryId]);
    }
}