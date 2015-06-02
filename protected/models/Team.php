<?php

/**
 * This is the model class for table "team".
 *
 * The followings are the available columns in table 'team':
 * @property integer $IdTeam
 * @property string $NameTeam
 * @property string $DescriptionTeam
 * @property string $EmailTeam
 * @property string $PasswordTeam
 * @property string $PageTeam
 * @property string $PhoneTeam
 * @property integer $IdGame
 */
class Team extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'team';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('NameTeam, PasswordTeam', 'required'),
			array('IdGame', 'numerical', 'integerOnly'=>true),
			array('DescriptionTeam, EmailTeam, PageTeam, PhoneTeam', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('IdTeam, NameTeam, DescriptionTeam, EmailTeam, PasswordTeam, PageTeam, PhoneTeam, IdGame', 'safe', 'on'=>'search'),
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
			'IdTeam' => 'Id Team',
			'NameTeam' => 'Name Team',
			'DescriptionTeam' => 'Description Team',
			'EmailTeam' => 'Email Team',
			'PasswordTeam' => 'Password Team',
			'PageTeam' => 'Page Team',
			'PhoneTeam' => 'Phone Team',
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

		$criteria->compare('IdTeam',$this->IdTeam);
		$criteria->compare('NameTeam',$this->NameTeam,true);
		$criteria->compare('DescriptionTeam',$this->DescriptionTeam,true);
		$criteria->compare('EmailTeam',$this->EmailTeam,true);
		$criteria->compare('PasswordTeam',$this->PasswordTeam,true);
		$criteria->compare('PageTeam',$this->PageTeam,true);
		$criteria->compare('PhoneTeam',$this->PhoneTeam,true);
		$criteria->compare('IdGame',$this->IdGame);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Team the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
