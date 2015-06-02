<?php

/**
 * This is the model class for table "results".
 *
 * The followings are the available columns in table 'results':
 * @property integer $IdResult
 * @property string $TimeTeam
 * @property integer $NumberTask
 * @property integer $PlaceTeam
 * @property integer $RatingTeam
 * @property integer $PointgameTeam
 * @property integer $PointTeam
 */
class Results extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'results';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('NumberTask, PlaceTeam, RatingTeam, PointgameTeam, PointTeam', 'numerical', 'integerOnly'=>true),
			array('TimeTeam', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('IdResult, TimeTeam, NumberTask, PlaceTeam, RatingTeam, PointgameTeam, PointTeam', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'IdResult' => 'Id Result',
			'TimeTeam' => 'Time Team',
			'NumberTask' => 'Number Task',
			'PlaceTeam' => 'Place Team',
			'RatingTeam' => 'Rating Team',
			'PointgameTeam' => 'Pointgame Team',
			'PointTeam' => 'Point Team',
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

		$criteria->compare('IdResult',$this->IdResult);
		$criteria->compare('TimeTeam',$this->TimeTeam,true);
		$criteria->compare('NumberTask',$this->NumberTask);
		$criteria->compare('PlaceTeam',$this->PlaceTeam);
		$criteria->compare('RatingTeam',$this->RatingTeam);
		$criteria->compare('PointgameTeam',$this->PointgameTeam);
		$criteria->compare('PointTeam',$this->PointTeam);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Results the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
