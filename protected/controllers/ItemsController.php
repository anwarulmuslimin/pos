<?php

class ItemsController extends Controller
{
	public function actionIndex()
	{
		$kode_toko	 		= $this->GetSekolahId();

		$crs 				= new CDbCriteria;
		$crs->order 		= "perusahaan ASC";

		$crk 				= new CDbCriteria;
		$crk->order 		= "nama_katagori ASC";

		$crj 				= new CDbCriteria;
		$crj->order 		= "nama_jenis ASC";

		$modkategori 		= Katagori::model()->findAll($crk);
		$modsupplier 		= Supplier::model()->findAll($crs);
		$modjenis 			= Jenis::model()->findAll($crj);
		$modtoko 	 		= TbToko::model()->findAll();

		$this->render('list_items',array(
			'modkategori'	=>$modkategori,
			'modsupplier'	=>$modsupplier,
			'modtoko'		=>$modtoko,
			'modjenis' 		=>$modjenis,
			'kode_toko' 	=>$kode_toko,
		));
	} 
 
	public function actionForm_eksport()
	{	
		session_start();
		$kategori_session 	= $_SESSION['status_kategori'];

		$pisah 				= explode("-",$kategori_session);
	 	$cek_sekolah 		= $pisah[0];
		$kode_kategori 		= $pisah[1];

		$id_sekolah 		= $this->GetSekolahId();
		
		if($cek_sekolah==$id_sekolah and $kode_kategori !=""){
			$cr_kategori 	= " and pos_item_kategori_id = '".$kode_kategori."'";
		}else{
			$cr_kategori 	= " and pos_item_sekolah_id='".$id_sekolah."'";
		}
		
		$cr_item 			= new CDbCriteria;
		$cr_item->order 	= "pos_item_nama  ASC";
		$cr_item->condition = "pos_item_status='show' ".$cr_kategori."";
		$mod_item 	 		= PosItem::model()->findAll($cr_item);
		
		$this->renderpartial('tampil_items',array('data'=>$mod_item,'mode'=>'excel','kode_kategori'=>$kode_kategori));
	} 	

	public function actionimport_item(){
		include 'excel_reader2.php';
	 	$nama_file = basename($_FILES['dataitem']['name']) ;
		 
		 move_uploaded_file($_FILES['dataitem']['tmp_name'], $nama_file);
	//	 chmod($_FILES['dataitem']['name'],0777);

		 $data 			= new Spreadsheet_Excel_Reader($nama_file);
		
		 $sukses 	= 0;
		 $gagal 	= 0;
		 for ($j = 2; $j <= $data->sheets[0]['numRows']; $j++){
		 
			$barcode           = $data->sheets[0]['cells'][$j][1];
			$nama_item 		   = $data->sheets[0]['cells'][$j][2];
			$kode_kategori 	   = $data->sheets[0]['cells'][$j][3];
			$harga_beli   	   = $data->sheets[0]['cells'][$j][4];
			$harga_jual  	   = $data->sheets[0]['cells'][$j][5];
			$stok 		   	   = $data->sheets[0]['cells'][$j][6];

			$cr_ite 				= new CDbCriteria;
			$cr_ite->condition 		= "pos_item_id='".$barcode."'";
			$data_item 				= PosItem::model()->find($cr_ite);
			
			if($data_item->pos_item_id !=""){
				$gagal++;
			}else{
				$simpan 						= new PosItem;
				$simpan->pos_item_id 			= $barcode;
				$simpan->pos_item_kategori_id 	= $kode_kategori;
				$simpan->pos_item_user_id 		= $this->GetUserId();
				$simpan->pos_item_sekolah_id 	= $this->GetSekolahId();
				$simpan->pos_item_harga_beli 	= $harga_beli;
				$simpan->pos_item_harga_jual 	= $harga_jual;
				$simpan->pos_item_stok 			= $stok;
				$simpan->pos_item_nama 			= $nama_item;
				$simpan->pos_item_status 		= 'show';
				
				if($simpan->save()){
					$sukses++;
				}else{
					$gagal++;
				}
			}
			
		 }

		 $this->redirect(array('index','sukses'=>$sukses,'gagal'=>$gagal));
	}

	public function actionViewitems()
	{	
	 	$toko 		 					= $_POST['toko'];
	 	$kategori 		 				= $_POST['kategori'];
		$nama_item 		 				= $_POST['nama_item'];
		$jenis 	 		 				= $_POST['jenis'];
	 	if(isset($_POST['page'])){
			$page 							= $_POST['page'];
		}else{
			$page 							= 1;
		}
		$limit 				= 25;
		
		if($kategori!=""){
			$cr_kategori 		= " and katagori = '".$kategori."'";
		}

		if($jenis!=""){
			$cr_jenis 		= " and jenis = '".$jenis."'";
		}

		if($nama_item!=""){
			$cr_nama 		= $nama_item;
		}else{
			$cr_nama 		= "";
		}
		
		$cr_item_all			= new CDbCriteria;
		$cr_item_all->order 	= "stock_toko  DESC";
		$cr_item_all->condition = "nama_barang like '%".$cr_nama."%' ".$cr_kategori." ".$cr_jenis."";
		$count 	 				= Barang::model()->count($cr_item_all);
		
		
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
		
		$cr_item_all->limit 				= $limit;
		$cr_item_all->offset 				= $offset;
		$mod_item 	 						= Barang::model()->findAll($cr_item_all);
		if($toko > 0){
			$this->renderpartial('tampil_items',array('data'=>$mod_item,'limit'=>$limit,'page'=>$page,'count'=>$halaman,'offset'=>$offset,'kode_kategori'=>$kategori,'toko'=>$toko));
		}else{
			echo ' Harus Pilih Toko ';
		}

	}
	
	public function actionSimpanitems()
	{			
		 $barcode 		 	= $_POST['barcode'];
		 $kategori 		 	= $_POST['kategori'];
		 $jenis  		 	= $_POST['jenis'];
	 	 $nama_item 		= $_POST['item'];
	 	 $jml_item 		 	= $_POST['jml'];
	 	 $harga_beli		= $_POST['beli'];
	 	 $harga_jual		= $_POST['jual'];
	 	 $supplier			= $_POST['supplier'];
		 $expaired			= $_POST['expaired'];
		  
		$cr_sp 				= new CDbCriteria;
		$cr_sp->condition 	= "no_id= '".$supplier."'";
		$modsupllier		= Supplier::model()->find($cr_sp);
		
		if($barcode!=""){
			$simpan_item 				= new Barang;
			$simpan_item->kode 			= $barcode;
			$simpan_item->nama_barang	= $nama_item;
			$simpan_item->katagori		= $kategori;
			$simpan_item->expaired		= $expaired;
			$simpan_item->stock_toko	= $jml_item;
			$simpan_item->stok_gudang	= $jml_item;
			$simpan_item->h_beli		= $harga_beli;
			$simpan_item->h_jual		= $harga_jual;
			$simpan_item->jenis 		= $jenis;
			$simpan_item->diskon  		= '0';
			$simpan_item->nama_suplier	= $modsupllier->perusahaan;
			$simpan_item->supplier		= $supplier;
			if($simpan_item->save()){
				echo 'Data Tersimpan.';
			}else{
				echo 'Data Gagal Disimpan.';
			}
		}else{
			echo 'Barcode Kosong, Data Gagal Disimpan.';
		}
	}
	
	public function actiondelete_item()
	{
		$id 		 		= $_POST['id'];
		$cr_item 			= new CDbCriteria;
		$cr_item->condition = "kode='".$id."'";

		if($id!=""){			
			Barang::model()->deleteAll($cr_item);
		}
		
	}
	
	public function actionedit_item()
	{	
			
		$pos_item_id 		= $_POST['id'];
		$lokasi 			= $_POST['lokasi'];

		$cr_item 			= new CDbCriteria;
		$cr_item->condition = "kode ='".$pos_item_id."'";
		$data_item 			= Barang::model()->find($cr_item);

		$kategori 			= $data_item->katagori;
		$jenis 		 		= $data_item->jenis;
		if($lokasi > 0){
			$this->renderpartial('form_edit_item',array('item'=>$data_item,'kategori'=>$kategori,'jenis'=>$jenis,'lokasi'=>$lokasi));
		}else{
			echo 'harus Pilih Toko ';
		}	
		
	}
	
	
	public function actionUpdateitems()
	{	
		$id_login 			= $this->GetUserId();
		
		$barcode 		 	= $_POST['barcode'];
		$lokasi 		 	= $_POST['lokasi'];
		$jenis 	 		 	= $_POST['jenis'];
		$kategori 		 	= $_POST['kategori'];
	 	$nama_item 		 	= $_POST['item'];
	 	$jml_item 		 	= $_POST['jml'];
	 	$harga_beli		 	= $_POST['beli'];
	 	$harga_jual		 	= $_POST['jual'];
		
		$cr_barcode 			= new CDbCriteria;
		$cr_barcode->condition 	= "kode='".$barcode."'";
		$UpdateItem			= Barang::model()->find($cr_barcode);

		if($UpdateItem->kode){
			Barang::model()->updateAll(array(
			'katagori'			 		=> $kategori,
			'jenis'			 			=> $jenis,
			'nama_barang' 				=> $nama_item,
			'h_beli'  			 		=> $harga_beli,
			'h_jual' 			 		=> $harga_jual,
			),$cr_barcode);
		}else{
			echo 'Data Gagal Disimpan.';
		}
	}

	public function actionform_import()
	{
		$this->render('form_import');
	} 

	public function actionkelola_item()
	{	
		$id_sekolah 	= $this->GetSekolahId();
		$cr_item 			= new CDbCriteria;
		$cr_item->condition	= "pos_item_sekolah_id='".$id_sekolah."'";
		$model 				= PosItem::model()->findAll($cr_item);

		$cr_kat 			= new CDbCriteria;
		$cr_kat->condition 	= "pos_kategori_sekolah_id='".$id_sekolah."'";
		$modkategori 		= PosKategori::model()->findAll($cr_kat);

		$this->render('kelola_item',array('data'=>$model,'modkategori'=>$modkategori));
	}

	public function actiontampil_kelolaitems()
	{	
		$kategori 		 	= $_POST['kategori'];
		$nama_item 		 	= $_POST['nama_item'];
		if(isset($_POST['page'])){
		   $page 							= $_POST['page'];
	   }else{
		   $page 							= 1;
	   }
	   $limit 				= 10;
	   
	   if($kategori!=""){
		   $cr_kategori 		= " and pos_item_kategori_id = '".$kategori."'";
	   }
	   if($nama_item!=""){
		   $cr_nama 		= $nama_item;
	   }else{
		   $cr_nama 		= "";
	   }
	   
	   $cr_item_all				= new CDbCriteria;
	   $cr_item_all->order 		= "pos_item_nama  ASC";
	   $cr_item_all->condition = "pos_item_status='hide' and pos_item_nama like '%".$cr_nama."%' ".$cr_kategori."";
	   $count 	 				= PosItem::model()->count($cr_item_all);
	   
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
	   
	   $cr_item 			= new CDbCriteria;
	   $cr_item->order 		= "pos_item_nama  ASC";
	   $cr_item->limit 		= $limit;
	   $cr_item->offset 	= $offset;
	   $cr_item->condition = "pos_item_status='hide' and pos_item_nama like '%".$cr_nama."%' ".$cr_kategori."";
	   $mod_item 	 		= PosItem::model()->findAll($cr_item);
	   
	   $this->renderpartial('tampil_kelola',array('data'=>$mod_item,'limit'=>$limit,'page'=>$page,'count'=>$halaman,'offset'=>$offset));
	}


	public function actiondelete_dataitem()
	{
		$pos_item_id 		= $_POST['pos_item_id'];
		$cr_item 			= new CDbCriteria;
	 	$cr_item->condition = "pos_item_id='".$pos_item_id."'";
				
		PosItem::model()->deleteAll($cr_item);
		
	}

}