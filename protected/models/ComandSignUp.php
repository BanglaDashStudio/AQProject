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
            /*array('mail','email','message'=>"email не корректен"),
            array('phone','numerical','message'=>"телефон не корректен (+7=8)"),*/
            array('username, phone, mail', 'unique'),
            array('username, password, passwordconfirm, phone, mail, description', 'safe'),
           /* array('password, passwordconfirm','length', 'min' => 6),
            array('password, passwordconfirm, username', 'length', 'max' => 25),*/
           // array('passwordconfirm','equation'),
        );
    }

    public function equation($attribute,$params)
    {
            if ($this->password !== $this->passwordconfirm) {
                $this->addError($attribute, 'Пароли не совпадают');
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
