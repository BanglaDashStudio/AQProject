<?php

class GameCreate extends CFormModel
{
    public $NameGame;
    public $DescriptionGame;
    public $StartGame;
    public $FinishGame;
    public $AcceptGame;
   // public $rememberMe=false;

    private $_identity;


    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('NameGame', 'required'),
            array('IdType', 'numerical', 'integerOnly'=>true),
            array('DescriptionGame, Date, StartGame, FinishGame, Comment', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('NameGame, DescriptionGame, IdType, Date, StartGame, FinishGame, Comment, AcceptGame', 'safe', 'on'=>'search'),
        );
    }

    public function attributeLabels()
    {
        return array(
            'NameGame' => 'Name Game',
            'DescriptionGame' => 'Description Game',
            'IdType' => 'Id Type',
            'Date' => 'Date',
            'StartGame' => 'Start Game',
            'FinishGame' => 'Finish Game',
            'Comment' => 'Comment',
            'AcceptGame' => 'Accept Game',
        );
    }

 }
