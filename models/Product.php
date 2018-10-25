<?php
namespace app\models;

class Product extends DataModel
{
    public $id;
    public $name;
    public $description;
    public $price;

    public static function getTableName()
    {
        return 'products';
    }

    public function getProductsWithDiscount()
    {

    }
}