<?php

/**
 * This is the model class for table "grid".
 *
 * The followings are the available columns in table 'grid':
 * @property integer $id
 * @property integer $teamId
 * @property integer $taskId
 * @property integer $orderTask
 * @property integer $timeTask
 *  * @property integer $timeForTask
 * @property integer $gameId
 */
class Grid extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'grid';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('gameId', 'required'),
			array('teamId, taskId, orderTask, timeTask, timeForTask, gameId', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, teamId, taskId, orderTask, timeTask,timeForTask, gameId', 'safe', 'on'=>'search'),
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
			'teamId' => 'Team',
			'taskId' => 'Task',
			'orderTask' => 'Order Task',
			'timeTask' => 'Time Task',
            'timeForTask' => 'timeForTask',
			'gameId' => 'Game',
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
		$criteria->compare('teamId',$this->teamId);
		$criteria->compare('taskId',$this->taskId);
		$criteria->compare('orderTask',$this->orderTask);
		$criteria->compare('timeTask',$this->timeTask);
        $criteria->compare('timeForTask',$this->timeForTask);
		$criteria->compare('gameId',$this->gameId);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Grid the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
