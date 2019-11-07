<?php

/**
 * This is the model class for table "return_barang_temp".
 *
 * The followings are the available columns in table 'return_barang_temp':
 * @property string $kode
 * @property string $tgl
 * @property integer $jml
 * @property string $alasan
 * @property string $Supplier
 * @property string $nama_barang
 * @property string $nota
 */
class Returnbarangtemp extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'return_barang_temp';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('jml', 'numerical', 'integerOnly'=>true),
			array('kode', 'length', 'max'=>13),
			array('tgl', 'length', 'max'=>30),
			array('alasan', 'length', 'max'=>225),
			array('Supplier', 'length', 'max'=>50),
			array('nama_barang', 'length', 'max'=>90),
			array('nota', 'length', 'max'=>60),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('kode, tgl, jml, alasan, Supplier, nama_barang, nota', 'safe', 'on'=>'search'),
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
			'tgl' => 'Tgl',
			'jml' => 'Jml',
			'alasan' => 'Alasan',
			'Supplier' => 'Supplier',
			'nama_barang' => 'Nama Barang',
			'nota' => 'Nota',
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
		$criteria->compare('tgl',$this->tgl,true);
		$criteria->compare('jml',$this->jml);
		$criteria->compare('alasan',$this->alasan,true);
		$criteria->compare('Supplier',$this->Supplier,true);
		$criteria->compare('nama_barang',$this->nama_barang,true);
		$criteria->compare('nota',$this->nota,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Returnbarangtemp the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
