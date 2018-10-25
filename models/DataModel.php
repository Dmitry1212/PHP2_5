<?php

namespace app\models;

use app\services\Db;

abstract class DataModel implements IModel
{
    private $db;

    public function __construct()
    {
        $this->db = static::getDb();
    }

    public static function getOne($id)
    {
        $table = static::getTableName();
        $sql = "SELECT * FROM {$table} WHERE id = :id";
        return static::getDb()->queryObject($sql, [':id' => $id], get_called_class());
    }

    public static function getAll()
    {
        $table = static::getTableName();
        $sql = "SELECT * FROM {$table}";
        return static::getDb()->queryAll($sql);
    }

    public function delete()
    {
        $sql = "DELETE FROM products WHERE id = :id";
        $this->db->execute($sql, [':id' => $this->id]);
    }

    private static function getDb(){
        return Db::getInstance();
    }

    //['name' => 'dkfjk']
    public function insert()
    {
        $columns = [];
        $params = [];

        foreach ($this as $key => $value) {
            if ($key == 'db') {
                continue;
            }

            $params[":{$key}"] = $value;
            $columns[] = "`{$key}`";
        }

        $columns = implode(", ", $columns);
        $placeholders = implode(", ", array_keys($params));

        $table = $this->getTableName();
        // INSERT INTO products (id, name, description) VALUES (:id, :name, :descritpion)
        $sql = "INSERT INTO `{$table}` ({$columns}) VALUES ({$placeholders})";
        $this->db->execute($sql, $params);
        $this->id = $this->db->lastInsertId();
    }

    public function update()
    {

    }

    public function save()
    {
        if(is_null($this->id)){
            $this->insert();
        }else{
            $this->update();
        }
    }

}