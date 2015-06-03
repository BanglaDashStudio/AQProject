<?php
/**
 * Created by PhpStorm.
 * User: lokirew
 * Date: 03.06.15
 * Time: 22:42
 */

class WebUser extends CWebUser {/*
    private $_model = null;

    function getRole() {
        if($user = $this->getModel()){
            // в таблице User есть поле role
            return $user->role;
        }
    }

    private function getModel(){
        if (!$this->isGuest && $this->_model === null){
            $this->_model = Team::model()->findByPk($this->id, array('select' => 'RoleTeam'));
        }
        return $this->_model;
    }*/
}