<?php

/**
 * This is the model class for table "barang".
 *
 * The followings are the available columns in table 'barang':
 * @property string $kode
 * @property string $nama_barang
 * @property double $h_beli
 * @property double $h_jual
 * @property double $stok_gudang
 * @property double $stock_toko
 * @property string $katagori
 * @property string $expaired
 * @property string $supplier
 * @property string $jenis
 * @property double $diskon
 * @property string $nama_suplier
 * @property double $size
 */
class Barang extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'barang';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	/*public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('h_beli, h_jual, stok_gudang, stock_toko, diskon, size', 'numerical'),
			array('kode', 'length', 'max'=>13),
			array('nama_barang', 'length', 'max'=>60),
			array('katagori, supplier, jenis', 'length', 'max'=>50),
			array('nama_suplier', 'length', 'max'=>100),
			array('expaired', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('kode, nama_barang, h_beli, h_jual, stok_gudang, stock_toko, katagori, expaired, supplier, jenis, diskon, nama_suplier, size', 'safe', 'on'=>'search'),
		);
	}*/

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
			'nama_barang' => 'Nama Barang',
			'h_beli' => 'H Beli',
			'h_jual' => 'H Jual',
			'stok_gudang' => 'Stok Gudang',
			'stock_toko' => 'Stock Toko',
			'katagori' => 'Katagori',
			'expaired' => 'Expaired',
			'supplier' => 'Supplier',
			'jenis' => 'Jenis',
			'diskon' => 'Diskon',
			'nama_suplier' => 'Nama Suplier',
			'size' => 'Size',
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
		$criteria->compare('nama_barang',$this->nama_barang,true);
		$criteria->compare('h_beli',$this->h_beli);
		$criteria->compare('h_jual',$this->h_jual);
		$criteria->compare('stok_gudang',$this->stok_gudang);
		$criteria->compare('stock_toko',$this->stock_toko);
		$criteria->compare('katagori',$this->katagori,true);
		$criteria->compare('expaired',$this->expaired,true);
		$criteria->compare('supplier',$this->supplier,true);
		$criteria->compare('jenis',$this->jenis,true);
		$criteria->compare('diskon',$this->diskon);
		$criteria->compare('nama_suplier',$this->nama_suplier,true);
		$criteria->compare('size',$this->size);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Barang the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public static function getItemBarcode($valueArray) {
		
		$elementId = $valueArray['itemId'] . "_bcode"; /*the div element id*/
        $value = $valueArray['barocde'];
        $type = 'code128'; /* you can set the type dynamically if you want valueArray eg - $valueArray['type']*/
        self::getBarcode(array('elementId' => $elementId, 'value' => $value, 'type' => $type)); 
		 
		return CHtml::tag('div', array('id' => $elementId));
    }
 
    /**
     * This function returns the item barcode
     */
    public static function getBarcode($optionsArray) {
 
        Yii::app()->getController()->widget('application.exstensions.barcode.Barcode', $optionsArray);
    }
}
