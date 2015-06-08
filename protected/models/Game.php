<?php

/**
 * This is the model class for table "game".
 *
 * The followings are the available columns in table 'game':
 * @property integer $IdGame
 * @property string $NameGame
 * @property string $DescriptionGame
 * @property string $Date
 * @property integer $IdType
 * @property string $StartGame
 * @property string $FinishGame
 * @property string $Comment
 * @property integer $AcceptGame
 * @property integer $IdTeam
 *
 * The followings are the available model relations:
 * @property Type $idType
 * @property Team $idTeam
 * @property Gameteam[] $gameteams
 * @property Grid[] $grs
 */
class Game extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'game';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('NameGame', 'required'),
            array('IdType, AcceptGame, IdTeam', 'numerical', 'integerOnly'=>true),
            array('Date', 'length', 'max'=>11),
            array('DescriptionGame, StartGame, FinishGame, Comment', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('IdGame, NameGame, DescriptionGame, Date, IdType, StartGame, FinishGame, Comment, AcceptGame, IdTeam', 'safe', 'on'=>'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'idType' => array(self::BELONGS_TO, 'Type', 'IdType'),
            'idTeam' => array(self::BELONGS_TO, 'Team', 'IdTeam'),
            'gameteams' => array(self::HAS_MANY, 'Gameteam', 'IdGame'),
            'grs' => array(self::HAS_MANY, 'Grid', 'IdGame'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'IdGame' => 'Id Game',
            'NameGame' => 'Name Game',
            'DescriptionGame' => 'Description Game',
            'Date' => 'Date',
            'IdType' => 'Id Type',
            'StartGame' => 'Start Game',
            'FinishGame' => 'Finish Game',
            'Comment' => 'Comment',
            'AcceptGame' => 'Accept Game',
            'IdTeam' => 'Id Team',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search()
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria=new CDbCriteria;

        $criteria->compare('IdGame',$this->IdGame);
        $criteria->compare('NameGame',$this->NameGame,true);
        $criteria->compare('DescriptionGame',$this->DescriptionGame,true);
        $criteria->compare('Date',$this->Date,true);
        $criteria->compare('IdType',$this->IdType);
        $criteria->compare('StartGame',$this->StartGame,true);
        $criteria->compare('FinishGame',$this->FinishGame,true);
        $criteria->compare('Comment',$this->Comment,true);
        $criteria->compare('AcceptGame',$this->AcceptGame);
        $criteria->compare('IdTeam',$this->IdTeam);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Game the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}