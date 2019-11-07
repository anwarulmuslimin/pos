<?php

/**
 * This is the model class for table "temp_penjualan".
 *
 * The followings are the available columns in table 'temp_penjualan':
 * @property integer $id
 * @property string $tanggal
 * @property string $kd_barang
 * @property double $jumlah
 * @property string $idtoko
 */
class TempPenjualan extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'temp_penjualan';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('jumlah', 'numerical'),
			array('kd_barang', 'length', 'max'=>13),
			array('idtoko', 'length', 'max'=>30),
			array('tanggal', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, tanggal, kd_barang, jumlah, idtoko', 'safe', 'on'=>'search'),
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
			'tanggal' => 'Tanggal',
			'kd_barang' => 'Kd Barang',
			'jumlah' => 'Jumlah',
			'idtoko' => 'Idtoko',
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
		$criteria->compare('tanggal',$this->tanggal,true);
		$criteria->compare('kd_barang',$this->kd_barang,true);
		$criteria->compare('jumlah',$this->jumlah);
		$criteria->compare('idtoko',$this->idtoko,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TempPenjualan the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
