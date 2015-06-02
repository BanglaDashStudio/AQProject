<?php

class GameCreate extends CFormModel
{
    public $NameGame;
    public $DescriptionGame;
    public $StartGame;
    public $FinishGame;
    public $Comment;
    public $AcceptGame;
    public $IdType;
   // public $rememberMe=false;

    private $_identity;


    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('NameGame', 'required'),
            array('IdType', 'numerical', 'integerOnly'=>true),
            array('DescriptionGame, StartGame, FinishGame, Comment', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('NameGame, DescriptionGame,  StartGame, FinishGame, IdType, Comment, AcceptGame', 'safe', 'on'=>'search'),
        );
    }

    public function attributeLabels()
    {
        return array(
            'NameGame' => 'имя игры',
            'DescriptionGame' => 'информация об игре',
            'IdType' => 'тип для заданий по умолчанию',
            'StartGame' => 'Начало',
            'FinishGame' => 'Завершение',
            'Comment' => 'комментарий',
        );
    }

 }
