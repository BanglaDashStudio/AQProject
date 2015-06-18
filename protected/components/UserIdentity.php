<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
    protected $_id = 1;

    /**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
        $modelIn=Team::model()->findByAttributes(array('name' => $this->username));
        if($modelIn == NULL)
            $this->errorCode=self::ERROR_USERNAME_INVALID;
        elseif(!CPasswordHelper::verifyPassword($this->password, $modelIn->password))
            $this->errorCode=self::ERROR_PASSWORD_INVALID;
        else {
            $this->errorCode = self::ERROR_NONE;
            $this->_id = $modelIn->id;
        }
        return !$this->errorCode;
	}

    public function getId(){
        return $this->_id;
    }
}