<?php

class Category extends Model {
    protected static $table = 'categories';

    protected static function setProperties()
    {
        self::$properties['name'] = array(
            'type' => 'varchar',
            'size' => 512
        );

        self::$properties['parent_id'] = array(
            'type' => 'int',
        );
    }

    public static function getCategories($parentId = 0)
    {
        return db::getInstance()->Select(
            'SELECT id_category, name FROM categories WHERE status=:status AND parent_id = :parent_id',
            array('status' => Status::Active, 'parent_id' => $parentId));

    }
}