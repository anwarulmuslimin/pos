<?php

class BarcodeController extends Controller
{
	public function actionIndex()
	{	
		$crk 			= new CDbCriteria;
		$crk->condition = "kode='00100429'";
		$model 			= Barang::model()->find($crk);
		$this->render('index',array('model'=>$model));
	}

	public function actionTampil_barcode()
	{	
		$kode 			= $_GET['kode'];
		$toko 			= $_GET['toko'];
		$crk 			= new CDbCriteria;
		$crk->condition = "kode='".$kode."'";
		$model 			= Barang::model()->find($crk);
		$jumlah_cetak 	= $model->stock_toko;
		$this->render('tampil_barcode',array('kode_barang'=>$kode));
	}  
   
	public function actionPrint_barcode()
	{	
		$kode 			= $_GET['kode'];
		$toko 			= $_GET['toko'];
		$crk 			= new CDbCriteria;
		$crk->condition = "kode='".$kode."'";
		$model 			= Barang::model()->find($crk);
		$jumlah_cetak 	= $model->stock_toko;
		$this->render('index',array('kode_barang'=>$kode,'total'=>$jumlah_cetak));
	}  
 
	public function actionbarcode13()
	{	
		$format 	= 'jpg'; 
		$symbology 	= 'ean-8'; 
		$data 		= '06543217'; 
		$option 	= 'cm'; 
		$this->render('barcode_ean13',array(
			'format'=>$format,
			'symbology'=>$symbology,
			'data'=>$data,
			'option'=>$option
		));
	} 
 
	public function actionCetak_barcode()
	{	
		$kode 			= $_POST['kode'];
		$total 			= $_POST['total'];
		$this->render('index',array('kode_barang'=>$kode,'total'=>$total,'mode'=>'pdf'));
	}	

	public function actionbarcodetes()
	{
		$this->render('barcodetes');
	}

	public function getvar($name){
		global $_GET, $_POST;
		if (isset($_GET[$name])) return $_GET[$name];
		else if (isset($_POST[$name])) return $_POST[$name];
		else return false;
	}

	public function actionbarcodepng()
	{
		Yii::import('application.exstensions.barcode.*'); 

		require("php-barcode.php");

		if (get_magic_quotes_gpc()){
			$code=stripslashes($this->getvar('code'));
		} else {
			$code=$this->getvar('code');
		}
		if (!$code) $code='123456789012';
		
		$data 	= barcode_print($code,$this->getvar('encoding'),$this->getvar('scale'),$this->getvar('mode'));
		
		$this->render('tampil_barcodepng',array('data'=>$data));
	}

}