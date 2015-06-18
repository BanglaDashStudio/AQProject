<?php

class GameCreate extends CFormModel
{
    public $NameGame;
    public $DescriptionGame;
    public $Date;
    public $StartGame;
    public $Type;
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

            array('NameGame', 'required'),
            array('DescriptionGame,  StartGame, Date, Comment, Type', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('NameGame, Date, DescriptionGame,  Date, StartGame, Type, Comment, AcceptGame', 'safe', 'on'=>'search'),
        );


    }

    public function attributeLabels()
    {
        return array(
            'NameGame' => 'Имя игры',
            'IdType' => 'тип',
            'IdTeam' => 'команда',
            'DescriptionGame' => 'Информация об игре, допы',
            'Date' =>'Дата',
            'StartGame' => 'Время начала',
            'Type' => 'Формат игры',
            'Comment' => 'Комментарий (если хотите)',
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
