<?php

/**
 * This is the model class for table "grid".
 *
 * The followings are the available columns in table 'grid':
 * @property integer $IdGrid
 * @property integer $IdTeam
 * @property integer $IdTask
 * @property integer $Order
 * @property integer $IdGame
 *
 * The followings are the available model relations:
 * @property Game $idGame
 * @property Team $idTeam
 * @property Task $idTask
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
			array('IdTeam, IdTask, Order, IdGame', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('IdGrid, IdTeam, IdTask, Order, IdGame', 'safe', 'on'=>'search'),
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
			'idGame' => array(self::BELONGS_TO, 'Game', 'IdGame'),
			'idTeam' => array(self::BELONGS_TO, 'Team', 'IdTeam'),
			'idTask' => array(self::BELONGS_TO, 'Task', 'IdTask'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'IdGrid' => 'Id Grid',
			'IdTeam' => 'Id Team',
			'IdTask' => 'Id Task',
			'Order' => 'Order',
			'IdGame' => 'Id Game',
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

		$criteria->compare('IdGrid',$this->IdGrid);
		$criteria->compare('IdTeam',$this->IdTeam);
		$criteria->compare('IdTask',$this->IdTask);
		$criteria->compare('Order',$this->Order);
		$criteria->compare('IdGame',$this->IdGame);

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
