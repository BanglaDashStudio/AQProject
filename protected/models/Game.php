<?php

/**
 * This is the model class for table "game".
 *
 * The followings are the available columns in table 'game':
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property integer $date
 * @property integer $start
 * @property integer $accepted
 * @property string $comment
 * @property string $type
 * @property integer $teamId
 * @property integer $orderLock
 * @property integer $finish
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
			array('name', 'required'),
			array('date, start, accepted, teamId, orderLock, finish', 'numerical', 'integerOnly'=>true),
			array('description, comment, type', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, description, date, start, accepted, comment, type, teamId, orderLock, finish', 'safe', 'on'=>'search'),
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
			'id' => 'ID',
			'name' => 'Name',
			'description' => 'Description',
			'date' => 'Date',
			'start' => 'Start',
			'accepted' => 'Accepted',
			'comment' => 'Comment',
			'type' => 'Type',
			'teamId' => 'Team',
			'orderLock' => 'Order Lock',
			'finish' => 'Finish',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('date',$this->date);
		$criteria->compare('start',$this->start);
		$criteria->compare('accepted',$this->accepted);
		$criteria->compare('comment',$this->comment,true);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('teamId',$this->teamId);
		$criteria->compare('orderLock',$this->orderLock);
		$criteria->compare('finish',$this->finish);

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
