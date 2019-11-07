<?php

/**
 * This is the model class for table "siadetailjurnal".
 *
 * The followings are the available columns in table 'siadetailjurnal':
 * @property string $NoJurnal
 * @property string $KodeAkun
 * @property double $Debet
 * @property double $Kredit
 * @property string $jns
 * @property string $bln
 * @property string $tgl
 * @property string $lokasi
 */
class Siadetailjurnal extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'siadetailjurnal';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('NoJurnal', 'required'),
			array('Debet, Kredit', 'numerical'),
			array('NoJurnal', 'length', 'max'=>25),
			array('KodeAkun', 'length', 'max'=>6),
			array('jns', 'length', 'max'=>15),
			array('bln', 'length', 'max'=>20),
			array('lokasi', 'length', 'max'=>5),
			array('tgl', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('NoJurnal, KodeAkun, Debet, Kredit, jns, bln, tgl, lokasi', 'safe', 'on'=>'search'),
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
			'NoJurnal' => 'No Jurnal',
			'KodeAkun' => 'Kode Akun',
			'Debet' => 'Debet',
			'Kredit' => 'Kredit',
			'jns' => 'Jns',
			'bln' => 'Bln',
			'tgl' => 'Tgl',
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

		$criteria->compare('NoJurnal',$this->NoJurnal,true);
		$criteria->compare('KodeAkun',$this->KodeAkun,true);
		$criteria->compare('Debet',$this->Debet);
		$criteria->compare('Kredit',$this->Kredit);
		$criteria->compare('jns',$this->jns,true);
		$criteria->compare('bln',$this->bln,true);
		$criteria->compare('tgl',$this->tgl,true);
		$criteria->compare('lokasi',$this->lokasi,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Siadetailjurnal the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
