<?php

class DiskonController extends Controller
{
	public $layout='column1';

	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
    }

    public function actionIndex()
	{
		$toko   		= TbToko::model()->findAll();
		$modkatagori 	= Katagori::model()->findAll();
		$this->render('index',array('toko'=>$toko,'modkatagori'=>$modkatagori));
	}
	

    public function actionTampil_daftar()
	{
		$toko   		= TbToko::model()->findAll();
		$modkatagori 	= Katagori::model()->findAll();
		$this->render('list_diskon',array('toko'=>$toko,'modkatagori'=>$modkatagori));
    }
    
    public function actionTampil_daftar_diskon()
	{
		$lokasi      = $_POST['lokasi'];
		$user_login  = $this->GetUserLogin();
		
		if($lokasi==""){
			$criteria 	= "";
		}else{
			$criteria 	= " lokasi = $lokasi and";
		}

		$cr_dsk             = new CDbCriteria;
		if($this->GetStatusUser()!="Admin"){
			$cr_dsk->condition  = "lokasi='".$lokasi."' and user='".$user_login."'  and kode like '%".$filter."%'";
		}else{
			$cr_dsk->condition  = " $criteria kode like '%".$filter."%'";
		}
		$model              = TempDiskon::model()->findAll($cr_dsk);
		$nama_toko 			= $this->GetNamaToko($lokasi);
		if($nama_toko ==""){

			$tampil_nama_toko 	= "Toko Keseluruhan";
		}else{

			$tampil_nama_toko 	= "Toko ".$this->GetNamaToko($lokasi);
		}
		
		$this->renderpartial('tampil_diskon',array('model'=>$model,'nama_toko'=>$tampil_nama_toko));
	}

	public function actionCari_barang()
	{
		$katagori      		= $_POST['katagori'];
		$filter 			= $_POST['filter'];
		$lokasi 			= $_POST['lokasi'];
		
		$cr_brg             = new CDbCriteria;
		$cr_brg->order      = "kode ASC";
		$cr_brg->condition  = "katagori='".$katagori."' and (kode like '".$filter."%' or nama_barang like '%".$filter."%')";
		$barang 			= Barang::model()->findAll($cr_brg);
		
		$this->renderpartial('form_diskon',array('barang'=>$barang,'lokasi'=>$lokasi));
	}

	public function actionSet_diskon()
	{
		$tot_urut      		= $_POST['total_barangdiskon'];
		$katagori      		= $_POST['katagori'];
		$user 				= $this->GetUserId();
		$lokasi      		= $_POST['lokasi'];
		$filter      		= $_POST['filter'];
		
		$cr_brg             = new CDbCriteria;
		$cr_brg->order      = "kode ASC";
		$cr_brg->condition  = "katagori='".$katagori."' and (kode like '%".$filter."%' or nama_barang like '%".$filter."%')";
		$barang 			= Barang::model()->findAll($cr_brg);

		$urut 	= 1; 
		foreach($barang as $barang){
			$harga 					= $this->GetHargaItem($barang->kode);
			$kode 	 				= $_POST['kode_'.$urut];
			$diskon 				= $_POST['nominal_'.$urut];
			$diskon_2 				= $_POST['nominal2_'.$urut];

			$cr_dsk             	= new CDbCriteria;
			if($lokasi==''){
				$cr_dsk->condition  = "kode='".$kode."'";
			}else{
				$cr_dsk->condition  = "kode='".$kode."' and lokasi='".$lokasi."'";
			}
			$update_diskon     	 	= TempDiskon::model()->find($cr_dsk);

			$rupiah_1 				= $update_diskon->nominal;
			$rupiah_2 				= $update_diskon->nominal_2;
			$persen_1 				= $update_diskon->diskon_1;
			$persen_2 				= $update_diskon->diskon_2;

			
			if($diskon > 0){
				$nom_persen_1		= $harga*($diskon/100);

				if($update_diskon->kode !=""){
					if($diskon != $update_diskon->diskon_1){
						/*disimpan diskon ke-1*/
						$persen_1 	= $diskon;
						$rupiah_1 	= $nom_persen_1;

						if($diskon_2 > 0){
							$hargadipotong_1 			= $harga - $nom_persen_1;
							$nom_persen_2 				= $hargadipotong_1*($diskon_2/100);
							/*disimpan diskon ke-2*/
							$persen_2 					= $diskon_2;
							$rupiah_2					= $nom_persen_2;
						}
					}else{
						if($diskon_2 > 0){
							$hargadipotong_1			= $harga-$nom_persen_1;
							$nom_persen_2				= $hargadipotong_1*($diskon_2/100);
							/*disimpan diskon ke-2*/
							$persen_2 					= $diskon_2;
							$rupiah_2					= $nom_persen_2;
						}
					}

					TempDiskon::model()->updateAll(array(
						'nominal'=>$rupiah_1,
						'nominal_2'=>$rupiah_2,
						'diskon_1'=>$persen_1,
						'diskon_2'=>$persen_2,
					),$cr_dsk);
				
				}else{
					$simpan 							= new TempDiskon;
					$simpan->kode 						= $kode;
					$simpan->lokasi						= $lokasi;
					$simpan->user						= $user;
					$simpan->diskon_1 					= $diskon;
					$simpan->nominal					= $nom_persen_1;
					$simpan->nominal_2					= 0;
					$simpan->diskon_2					= 0;
					$simpan->status						= 1;
					$simpan->save();
				}
				
			}else{
				$cr_del 			= new CDbCriteria;
				$cr_del->condition 	= "kode=".$update_diskon->kode." and lokasi=".$lokasi."";
				$delete_diskon 		= TempDiskon::model()->deleteAll($cr_del);

			}
			$urut++;
		}
	}


}

				