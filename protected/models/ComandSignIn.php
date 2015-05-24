<?php

/**
 * This is the model class for table "Comand".
 *
 * The followings are the available columns in table 'Comand':
 * @property string $Name
 * @property string $Pass
 */
class ComandSignIn extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Name, Pass', 'required'),
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

			'Name' => 'Ваш логин',
			'Pass' => 'Ваш пароль',
		);
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Comand the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
