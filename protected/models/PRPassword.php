<?php

class PRPassword extends CFormModel
{
    public $oldpassword;
    public $newpassword;
    public $confpassword;
   // public $rememberMe=false;

    private $_identity;

    public function rules()
    {
        return array(
            array('oldpassword, newpassword, confpassword', 'required'),
        //    array('rememberMe', 'boolean'),
        //    array('password', 'authenticate'),
            array('oldpassword','passvalidate'),
            array('confpassword','equation'),
        );
    }

    public function equation($attribute,$params)
    {
        if($this->newpassword != $this->confpassword) {
            $this->addError('confpassword', 'Пароли не совпадают');
        }
    }

    public function passvalidate($attribute,$params)
    {
        $modelPR=Team::model()->findByAttributes(array('NameTeam'=>Yii::app()->user->name));

        if($modelPR == NULL)
            $this->addError('oldpassword','Неправильный пароль');
        elseif(!CPasswordHelper::verifyPassword($this->oldpassword, $modelPR->PasswordTeam))
            $this->addError('oldpassword','Неправильный пароль.');

    }

    public function attributeLabels()
    {
        return array(
            'oldpassword' => 'Введите старый пароль',
            'newpassword' => 'Введите новый пароль' ,
            'confpassword' => 'Повторите новый пароль',
        );
    }


   /* public function authenticate($attribute,$params)
    {
        $this->_identity=new UserIdentity($this->username,$this->password);
        if(!$this->_identity->authenticate())
            $this->addError('password','Неправильное имя пользователя или пароль.');
    }*/
}
