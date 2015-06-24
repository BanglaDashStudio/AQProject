<?php
/**
 * Created by PhpStorm.
 * User: lokirew
 * Date: 03.06.15
 * Time: 22:42
 */

class WebUser extends CWebUser {
    private $_model = null;

    public function isAdmin() {
        if($this->getRole()==='admin')
            return true;
        else
            return false;
    }

    public function isOrg() {
        if($this->getRole()==='org')
            return true;
        else
            return false;
    }

    public function isCreator() {
        if($this->getRole() === 'creator')
            return true;
        else
            return false;
    }

    public function isUser() {
        if($this->getRole()==='user')
            return true;
        elseif($this->getRole()==='admin' || $this->getRole()==='org' || $this->getRole()==='creator')
            return true;
        else
            return false;
    }

    function getRole() {
        if($user = $this->getModel()){
            if($user->role == 1) {
                return 'admin';
            } elseif($user->role == 0) {
                return 'user';
            } elseif($user->role == 2 || $user->role == 5) {
                return 'org';
            }  elseif($user->role == 3) {
                return 'creator';
            } else {
                return 'guest';
            }
        }
    }

    private function getModel(){
        if (!$this->isGuest && $this->_model === null){
            $this->_model = Team::model()->findByPk($this->id, array('select' => 'role'));
        }

        return $this->_model;
    }
}