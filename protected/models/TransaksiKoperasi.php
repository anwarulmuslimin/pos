<?php

/**
 * This is the model class for table "transaksi_koperasi".
 *
 * The followings are the available columns in table 'transaksi_koperasi':
 * @property integer $id
 * @property string $NoNota
 * @property string $kasir
 * @property string $TglNota
 * @property double $bayar
 * @property double $diskon
 * @property double $kembalian
 * @property string $lokasi
 */
class TransaksiKoperasi extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'transaksi_koperasi';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id', 'numerical', 'integerOnly'=>true),
			array('bayar, diskon, kembalian', 'numerical'),
			array('NoNota, kasir, TglNota', 'length', 'max'=>50),
			array('lokasi', 'length', 'max'=>2),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, NoNota, kasir, TglNota, bayar, diskon, kembalian, lokasi', 'safe', 'on'=>'search'),
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
			'NoNota' => 'No Nota',
			'kasir' => 'Kasir',
			'TglNota' => 'Tgl Nota',
			'bayar' => 'Bayar',
			'diskon' => 'Diskon',
			'kembalian' => 'Kembalian',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('NoNota',$this->NoNota,true);
		$criteria->compare('kasir',$this->kasir,true);
		$criteria->compare('TglNota',$this->TglNota,true);
		$criteria->compare('bayar',$this->bayar);
		$criteria->compare('diskon',$this->diskon);
		$criteria->compare('kembalian',$this->kembalian);
		$criteria->compare('lokasi',$this->lokasi,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TransaksiKoperasi the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
