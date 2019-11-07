<?php

/**
 * This is the model class for table "item".
 *
 * The followings are the available columns in table 'item':
 * @property string $iNonota
 * @property string $iKodeBr
 * @property integer $iJumlah
 * @property integer $iharga
 * @property integer $iTotal
 * @property string $igolongan
 * @property string $isuplier
 * @property double $idiskon
 * @property string $tgl
 * @property string $user
 * @property string $lokasi
 * @property double $ibeli
 */
class Item extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'item';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('iJumlah, iharga, iTotal', 'numerical', 'integerOnly'=>true),
			array('idiskon, ibeli', 'numerical'),
			array('iNonota', 'length', 'max'=>25),
			array('iKodeBr, igolongan, isuplier', 'length', 'max'=>50),
			array('user', 'length', 'max'=>30),
			array('lokasi', 'length', 'max'=>2),
			array('tgl', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('iNonota, iKodeBr, iJumlah, iharga, iTotal, igolongan, isuplier, idiskon, tgl, user, lokasi, ibeli', 'safe', 'on'=>'search'),
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
			'iNonota' => 'I Nonota',
			'iKodeBr' => 'I Kode Br',
			'iJumlah' => 'I Jumlah',
			'iharga' => 'Iharga',
			'iTotal' => 'I Total',
			'igolongan' => 'Igolongan',
			'isuplier' => 'Isuplier',
			'idiskon' => 'Idiskon',
			'tgl' => 'Tgl',
			'user' => 'User',
			'lokasi' => 'Lokasi',
			'ibeli' => 'Ibeli',
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

		$criteria->compare('iNonota',$this->iNonota,true);
		$criteria->compare('iKodeBr',$this->iKodeBr,true);
		$criteria->compare('iJumlah',$this->iJumlah);
		$criteria->compare('iharga',$this->iharga);
		$criteria->compare('iTotal',$this->iTotal);
		$criteria->compare('igolongan',$this->igolongan,true);
		$criteria->compare('isuplier',$this->isuplier,true);
		$criteria->compare('idiskon',$this->idiskon);
		$criteria->compare('tgl',$this->tgl,true);
		$criteria->compare('user',$this->user,true);
		$criteria->compare('lokasi',$this->lokasi,true);
		$criteria->compare('ibeli',$this->ibeli);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Item the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
