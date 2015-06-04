<?php

class GameCreate extends CFormModel
{
    public $NameGame;
    public $DescriptionGame;
    public $Date;
    public $StartGame;
    public $FinishGame;
    public $Comment;
    public $AcceptGame;
    public $IdTeam;
   // public $rememberMe=false;

    private $_identity;

    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('Date', 'date', 'format'=>'yy-mm-dd'),
            array('NameGame', 'required'),
            array('DescriptionGame,  StartGame, FinishGame, Comment', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('NameGame, DescriptionGame,  Date, StartGame, FinishGame, Comment, AcceptGame', 'safe', 'on'=>'search'),
        );


    }

    public function attributeLabels()
    {
        return array(
            'NameGame' => 'имя игры',
            'IdType' => 'тип',
            'IdTeam' => 'команда',
            'DescriptionGame' => 'информация об игре',
            'Date' =>'дата',
            'StartGame' => 'Начало',
            'FinishGame' => 'Завершение',
            'Comment' => 'комментарий',
        );
    }

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

 }
