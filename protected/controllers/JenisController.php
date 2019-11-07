<?php

class JenisController extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
	}

	public function actionview_jenis()
	{	
		$nama_jenis 						= $_POST['jenis'];

		if(isset($_POST['page'])){
			$page 							= $_POST['page'];
		}else{
			$page 							= 1;
		}
		

		$cr 								= new CDbCriteria;
		$cr->order 							= "nama_jenis ASC";
		if($nama_jenis!=""){
	  	 $cr->condition  					= "nama_jenis  like '%".$nama_jenis."%'";
		}
		$count 	 							= Jenis::model()->count($cr);
		$limit 								= 25;
		if($count>0){
			$halaman 						= round($count/$limit);
		}
		
		if(($halaman*$limit)>=$count){
			$halaman 						= $halaman;
		}else{
			$halaman 						= $halaman+1;
		}
				
		if($page<1){
			$page 							= 1;
		}
		
		if($page>$halaman){
			$page							= $halaman;
		}
		
		
	
		$offset 							= ($page - 1) * $limit;
		
		$cr->limit 							= $limit;
		$cr->offset 						= $offset;
				
		$modjenis							= Jenis::model()->findAll($cr);
		$this->renderpartial('tampil_jenis',array('modjenis'=>$modjenis,'limit'=>$limit,'page'=>$page,'count'=>$halaman,'offset'=>$offset));
	}

	public function actiontampil_jenis()
	{	
		$modjenis							= Jenis::model()->findAll();
		$this->renderpartial('tampil_jenis',array('modjenis'=>$modjenis));
	}

	public function actionlihat_stok_gudang()
	{
		$cr_b 				= new CDbCriteria;
		$barang 			= Barang::model()->findAll();
		$this->renderpartial('lihat_stok_gudang',array('barang'=>$barang));
	}

	public function actiontemp_mutasi()
	{
		$this->renderpartial('temp_mutasi');
	}
}