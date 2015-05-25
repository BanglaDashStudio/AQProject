<?php

class ComandSignIn extends CFormModel
{
    public $username;
    public $password;
   // public $rememberMe=false;

    private $_identity;

    public function rules()
    {
        return array(
            array('username, password', 'required'),
        //    array('rememberMe', 'boolean'),
            array('password', 'authenticate'),
        );
    }

    public function authenticate($attribute,$params)
    {
        $this->_identity=new UserIdentity($this->username,$this->password);
        if(!$this->_identity->authenticate())
            $this->addError('password','Неправильное имя пользователя или пароль.');
    }
}
