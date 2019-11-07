<?php

class LaporanController extends Controller
{
	public function actionLaporan_barang()
	{	
		//$this->render('index');
		$this->render('laporan_barang'); 
	}

	public function actiontampil_barang()
	{
		$cr_b 				= new CDbCriteria;
		$cr_b->order 		= "nama_barang ASC";
		$model 				= Barang::model()->findAll($cr_b);
		$this->renderpartial('tampil_laporan_barang',array('model'=>$model));
	}

	public function actionLaporan_penjualan()
	{	
		//$this->render('index');
		$this->render('laporan_penjualan');
	}

	public function actionLaporan_pembelian()
	{	
		//$this->render('index');
		$this->render('laporan_pembelian');
	}

	public function actionRetur_barang()
	{	
		//$this->render('index');
		$this->render('laporan_retur');
	}


}