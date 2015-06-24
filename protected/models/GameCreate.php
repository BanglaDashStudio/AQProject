<?php

class GameCreate extends CFormModel
{
    public $name;
    public $description;
    public $date;
    public $start;
    public $type;
    public $comment;
    public $teamId;
   // public $rememberMe=false;

    private $_identity;

    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(

            array('name', 'required'),
            array('name', 'unique','className'=>'Game', 'attributeName'=>'name','message'=>'Игра с таким именем уже существует.'),
            array('description,  start, date, comment, type', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('name, date, description, start, type, comment', 'safe', 'on'=>'search'),
        );


    }

    public function attributeLabels()
    {
        return array(
            'name' => 'Имя игры',
            'teamId' => 'команда',
            'description' => 'Информация об игре, допы',
            'date' =>'Дата',
            'startGame' => 'Время начала',
            'type' => 'Формат игры',
            'comment' => 'Комментарий (если хотите)',
        );
    }
 /*
    protected function beforeSave() {
        if(parent::beforeSave()) {
            $this->Date = strtotime($this->Date);
            return true;
        } else {
            return false;
        }
    }

    protected function afterFind() {
        $date = date('yy-mm-dd', $this->Date);
        $this->Date = $date;
        parent::afterFind();
    }
*/
 }
