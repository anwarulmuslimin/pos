<?php

/**
 * This is the model class for table "pembelian_temp".
 *
 * The followings are the available columns in table 'pembelian_temp':
 * @property string $kode
 * @property string $tgl
 * @property double $harga
 * @property string $suplier
 * @property integer $jumlah
 * @property string $barang
 * @property string $periode
 * @property string $user
 * @property string $jam
 * @property string $nota
 * @property string $toko
 * @property string $nama_suplier
 */
class PembelianTemp extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'pembelian_temp';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('jumlah', 'numerical', 'integerOnly'=>true),
			array('harga', 'numerical'),
			array('kode, user, jam, nota', 'length', 'max'=>50),
			array('tgl', 'length', 'max'=>30),
			array('suplier', 'length', 'max'=>255),
			array('barang, periode', 'length', 'max'=>120),
			array('toko', 'length', 'max'=>150),
			array('nama_suplier', 'length', 'max'=>80),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('kode, tgl, harga, suplier, jumlah, barang, periode, user, jam, nota, toko, nama_suplier', 'safe', 'on'=>'search'),
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
			'harga' => 'Harga',
			'suplier' => 'Suplier',
			'jumlah' => 'Jumlah',
			'barang' => 'Barang',
			'periode' => 'Periode',
			'user' => 'User',
			'jam' => 'Jam',
			'nota' => 'Nota',
			'toko' => 'Toko',
			'nama_suplier' => 'Nama Suplier',
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
		$criteria->compare('harga',$this->harga);
		$criteria->compare('suplier',$this->suplier,true);
		$criteria->compare('jumlah',$this->jumlah);
		$criteria->compare('barang',$this->barang,true);
		$criteria->compare('periode',$this->periode,true);
		$criteria->compare('user',$this->user,true);
		$criteria->compare('jam',$this->jam,true);
		$criteria->compare('nota',$this->nota,true);
		$criteria->compare('toko',$this->toko,true);
		$criteria->compare('nama_suplier',$this->nama_suplier,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PembelianTemp the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
