<?php

/**
 * This is the model class for table "mutasi".
 *
 * The followings are the available columns in table 'mutasi':
 * @property string $tgl
 * @property string $kode
 * @property double $jml
 * @property string $barang
 * @property string $toko
 * @property string $user
 * @property string $jam
 * @property string $alamat
 * @property string $telp
 * @property double $nota
 * @property string $h_jual
 * @property string $lokasi
 */
class Mutasi extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'mutasi';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('alamat, telp, nota', 'required'),
			array('jml, nota', 'numerical'),
			array('tgl', 'length', 'max'=>50),
			array('kode', 'length', 'max'=>13),
			array('barang', 'length', 'max'=>255),
			array('toko', 'length', 'max'=>222),
			array('user', 'length', 'max'=>60),
			array('alamat', 'length', 'max'=>225),
			array('telp, h_jual', 'length', 'max'=>15),
			array('lokasi', 'length', 'max'=>2),
			array('jam', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('tgl, kode, jml, barang, toko, user, jam, alamat, telp, nota, h_jual, lokasi', 'safe', 'on'=>'search'),
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
			'tgl' => 'Tgl',
			'kode' => 'Kode',
			'jml' => 'Jml',
			'barang' => 'Barang',
			'toko' => 'Toko',
			'user' => 'User',
			'jam' => 'Jam',
			'alamat' => 'Alamat',
			'telp' => 'Telp',
			'nota' => 'Nota',
			'h_jual' => 'H Jual',
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

		$criteria->compare('tgl',$this->tgl,true);
		$criteria->compare('kode',$this->kode,true);
		$criteria->compare('jml',$this->jml);
		$criteria->compare('barang',$this->barang,true);
		$criteria->compare('toko',$this->toko,true);
		$criteria->compare('user',$this->user,true);
		$criteria->compare('jam',$this->jam,true);
		$criteria->compare('alamat',$this->alamat,true);
		$criteria->compare('telp',$this->telp,true);
		$criteria->compare('nota',$this->nota);
		$criteria->compare('h_jual',$this->h_jual,true);
		$criteria->compare('lokasi',$this->lokasi,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Mutasi the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
