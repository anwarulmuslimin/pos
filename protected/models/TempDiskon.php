<?php

/**
 * This is the model class for table "temp_diskon".
 *
 * The followings are the available columns in table 'temp_diskon':
 * @property string $kode
 * @property string $nominal
 * @property string $lokasi
 * @property string $user
 * @property double $diskon_1
 * @property string $nominal_2
 * @property double $diskon_2
 * @property string $status
 */
class TempDiskon extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'temp_diskon';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('kode', 'required'),
			array('diskon_1, diskon_2', 'numerical'),
			array('kode', 'length', 'max'=>12),
			array('nominal, nominal_2', 'length', 'max'=>255),
			array('lokasi', 'length', 'max'=>5),
			array('user', 'length', 'max'=>10),
			array('status', 'length', 'max'=>1),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('kode, nominal, lokasi, user, diskon_1, nominal_2, diskon_2, status', 'safe', 'on'=>'search'),
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
			'kode' => 'Kode',
			'nominal' => 'Nominal',
			'lokasi' => 'Lokasi',
			'user' => 'User',
			'diskon_1' => 'Diskon 1',
			'nominal_2' => 'Nominal 2',
			'diskon_2' => 'Diskon 2',
			'status' => 'Status',
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

		$criteria->compare('kode',$this->kode,true);
		$criteria->compare('nominal',$this->nominal,true);
		$criteria->compare('lokasi',$this->lokasi,true);
		$criteria->compare('user',$this->user,true);
		$criteria->compare('diskon_1',$this->diskon_1);
		$criteria->compare('nominal_2',$this->nominal_2,true);
		$criteria->compare('diskon_2',$this->diskon_2);
		$criteria->compare('status',$this->status,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TempDiskon the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
