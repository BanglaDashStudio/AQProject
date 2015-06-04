<?php

/**
 * This is the model class for table "hint".
 *
 * The followings are the available columns in table 'hint':
 * @property integer $IdHint
 * @property integer $IdTask
 * @property string $DescriptionHint
 * @property integer $Number
 *
 * The followings are the available model relations:
 * @property Task $idTask
 */
class Hint extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'hint';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('IdTask, Number', 'numerical', 'integerOnly'=>true),
			array('DescriptionHint', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('IdHint, IdTask, DescriptionHint, Number', 'safe', 'on'=>'search'),
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
			'idTask' => array(self::BELONGS_TO, 'Task', 'IdTask'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'IdHint' => 'Id Hint',
			'IdTask' => 'Id Task',
			'DescriptionHint' => 'Description Hint',
			'Number' => 'Number',
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

		$criteria->compare('IdHint',$this->IdHint);
		$criteria->compare('IdTask',$this->IdTask);
		$criteria->compare('DescriptionHint',$this->DescriptionHint,true);
		$criteria->compare('Number',$this->Number);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Hint the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
