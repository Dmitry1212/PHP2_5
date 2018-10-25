<?php

namespace app\models;

class User extends DataModel
{
    public $id;
    public $login;
    public $password;


    public static function getTableName()
    {
        return 'users';
    }

    public function getUserByRole()
    {

    }

}