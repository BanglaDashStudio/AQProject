<?php

class ComandSignUp extends CFormModel
{
    public $username;
    public $password;
    public $passwordconfirm;
    public $phone;
    public $mail;
    public $description;
   // public $rememberMe=false;

    public function rules()
    {
        return array(
            array('username, password, passwordconfirm, phone, mail', 'required'),
        //    array('rememberMe', 'boolean'),
            array('username, phone, mail', 'unique'),
            array('username, password, passwordconfirm, phone, mail, description', 'safe'),
            array('passwordconfirm','equation'),
            array('mail','email'),
        );
    }

    public function equation($attribute,$params)
    {
        if(!$this->hasErrors()) {
            if ($this->password != $this->passwordconfirm) {
                $this->addError('passwordconfirm', 'Пароли не совпадают');
            }
        }
    }

    public function attributeLabels()
    {
        return array(
            'username' => 'Введите название команды',
            'password' => 'Введите пароль',
            'passwordconfirm' => 'Повторите пароль',
            'phone' => 'Телефон',
            'mail' => '@mail',
            'description' => 'Дополнительная информация',
        );
    }



}
