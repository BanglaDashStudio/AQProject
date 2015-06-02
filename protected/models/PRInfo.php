<?php

class PRInfo extends CFormModel
{
    public $phone;
    public $mail;
    public $inform;

    // TODO: реализовать валидацию телефона и мыла
    public function rules()
    {
        return array(
            array('phone, mail, inform', 'required'),
            //    array('rememberMe', 'boolean'),
            //    array('password', 'authenticate'),
        );
    }


    public function attributeLabels()
    {
        return array(
            'phone' => 'Номер телефона',
            'mail' => 'Почта' ,
            'inform' => 'Информация о команде',
        );
    }


}
