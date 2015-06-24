<?php

class PRInfo extends CFormModel
{
    public $phone;
    public $mail;
    public $page;
    public $inform;


    public function rules()
    {
        return array(
            array('phone, mail', 'required'),
            array('mail', 'email', 'message' => 'Введите почту корректно. '),
            array('phone', 'numerical', 'integerOnly' => true, 'message' => 'Введите номер телефона корректно. '),
            //    array('rememberMe', 'boolean'),
            //    array('password', 'authenticate'),
        );
    }


    public function attributeLabels()
    {
        return array(
            'phone' => 'Номер телефона',
            'mail' => 'Почта' ,
            'page' => 'Соц сеть' ,
            'inform' => 'Информация о команде',
        );
    }


}
