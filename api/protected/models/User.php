<?php
class User extends CActiveRecord
{
    public $id;
    public $name;
    public $email;
    public $password_hash;
    public $status;
    public $created_at;

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'Users';
    }
}

