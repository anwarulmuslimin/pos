<?php

/**
 * This is the model class for table "header".
 *
 * The followings are the available columns in table 'header':
 * @property string $head
 * @property string $head1
 * @property string $kota
 * @property string $nb
 * @property string $nb2
 * @property string $lokasi
 */
class Header extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'header';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('head, kota', 'length', 'max'=>100),
			array('head1', 'length', 'max'=>255),
			array('lokasi', 'length', 'max'=>2),
			array('nb, nb2', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('head, head1, kota, nb, nb2, lokasi', 'safe', 'on'=>'search'),
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
			'head' => 'Head',
			'head1' => 'Head1',
			'kota' => 'Kota',
			'nb' => 'Nb',
			'nb2' => 'Nb2',
			'lokasi' => 'Lokasi',
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

		$criteria->compare('head',$this->head,true);
		$criteria->compare('head1',$this->head1,true);
		$criteria->compare('kota',$this->kota,true);
		$criteria->compare('nb',$this->nb,true);
		$criteria->compare('nb2',$this->nb2,true);
		$criteria->compare('lokasi',$this->lokasi,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Header the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
