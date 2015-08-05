<?php
/**
 * Created by PhpStorm.
 * User: Anton
 * Date: 27.06.2015
 * Time: 23:14
 */

class TaskCreate extends CFormModel
{
    public $name;
    public $address;
    public $type;
    public $description;
    public $code;

    public function rules()
    {
        return array(
            array('name, description, code, address', 'required'),
            //array('code' ,'numerical'),//добавить валидацию типа по регэкспу
        );
    }
    public function attributeLabels()
    {
        return array(
            'address'=>'Адрес',
            'name'=>'Название',
            'type'=>'Тип',
            'description'=>'Задание',
            'code'=>'Код'
        );
    }
}