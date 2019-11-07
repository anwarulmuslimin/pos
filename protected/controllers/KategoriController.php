<?php

class KategoriController extends Controller
{
	public function beforeAction($id)
	{
		$this->CekLogin();
	   	return true; 
	}
	
	public function actionList()
	{
		$this->render('index');
	}

	public function actionIndex()
	{	
		$this->render('list_kategori');
	}
	
	public function actionview_kategori()
	{	
		$nama_kategori 			= $_POST['kategori'];
				
		$cr_kategori 			= new CDbCriteria;
		$cr_kategori->order 	= "nama_katagori ASC";
		 if($nama_kategori!=""){
	  	$cr_kategori->condition = "nama_katagori  like ' %".$nama_kategori."'";
		}
		$modkategori 			= Katagori::model()->findAll($cr_kategori);
		$this->renderpartial('tampil_kategori',array('modkategori'=>$modkategori));
	}
	
	public function actionadd_kategori()
	{	
		session_start();
		$sekolah_id 	= $_SESSION['sekolah_idlogin'];
		$id_login 		= $_SESSION['id_login'];
		$nama_kategori 	= $_POST['kategori'];
		
		$cr_id 				= new CDbCriteria;
		$cr_id->order 	 	= "pos_kategori_id DESC";
		$max_id 			= PosKategori::model()->find($cr_id);
		
		if($max_id->pos_kategori_id!=''){
			$id_max 		= $max_id->pos_kategori_id + 1;
		}else{
			$id_max 		= 1;
		}
		
		if($nama_kategori!=""){
			$simpan_kategori 								= new PosKategori;
			$simpan_kategori->pos_kategori_id 				= $id_max;
			$simpan_kategori->pos_kategori_sekolah_id		= $sekolah_id;
			$simpan_kategori->pos_kategori_user_id			= $id_login;
			$simpan_kategori->pos_kategori_nama 			= $nama_kategori;
			$simpan_kategori->pos_kategori_status 			= '1';
			$simpan_kategori->save();
		}
	}
	
	public function actionedit_kategori()
	{	
		$id_kategori 		= $_POST['id'];
		$cr_id 				= new CDbCriteria;
		$cr_id->condition 	= "pos_kategori_id='".$id_kategori."'";
		$modkategori 		= PosKategori::model()->find($cr_id);
				
		$this->renderpartial('form_edit_kategori',array('modkategori'=>$modkategori));
	}
	
	public function actiondelete_kategori()
	{	
		$id_kategori 					= $_POST['id'];
		$cr_id_kategori 				= new CDbCriteria;
		$cr_id_kategori 				= "pos_kategori_id='".$id_kategori."'";
		
		PosKategori::model()->updateAll(array('pos_kategori_status'=>0),$cr_id_kategori);
		
	}
	
	public function actionupdate_kategori()
	{	
		$id_kategori 		= $_POST['id'];
		$kategori 			= $_POST['kategori'];
		$cr_id_kategori 	= new CDbCriteria;
		$cr_id_kategori 	= "pos_kategori_id='".$id_kategori."'";
		PosKategori::model()->updateAll(array('pos_kategori_nama'=>$kategori),$cr_id_kategori);
	}


	public function actionkelola_kategori()
	{	
		$this->render('kelola_kategori');
	}


	public function actiontampil_kelolakategori()
	{	
		 $sekolah_id 			= $this->GetSekolahId();
		$nama_kategori 			= $_POST['kategori'];
		
		if($nama_kategori!=""){
			$cr_nama 	= " and pos_kategori_nama like '%".$nama_kategori."%'";
		}
		
		$cr_kategori 			= new CDbCriteria;
	 	$cr_kategori->order 	= "pos_kategori_nama ASC";
	 	$cr_kategori->condition = "pos_kategori_sekolah_id=".$sekolah_id."  and pos_kategori_status='0' ".$cr_nama."";
		$modkategori 			= PosKategori::model()->findAll($cr_kategori);
		$this->renderpartial('tampil_kelolakategori',array('modkategori'=>$modkategori));
	}
	
	public function actiondelete_kelolakategori()
	{	
		$id_kategori 					= $_POST['id'];
		$cr_id_kategori 				= new CDbCriteria;
		$cr_id_kategori 				= "pos_kategori_id='".$id_kategori."'";
		
		PosKategori::model()->deleteAll($cr_id_kategori);
		
	}

	public function actionsupplier()
	{	
		$this->render('supplier');
		
	}

	public function actionview_supplier()
	{
		$supplier 	= $_POST['supplier'];

		if(isset($_POST['page'])){
			$page 							= $_POST['page'];
		}else{
			$page 							= 1;
		}
		$limit 				= 10;
		$crsp 				= new CDbCriteria;
		if($supplier !=""){
			$crsp->condition 	= "no_id like '%".$supplier."%' or perusahaan like '%".$supplier."%'";
		}
		$count 	 			= Supplier::model()->count($crsp);

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
		
		$crsp->limit 					= $limit;
		$crsp->offset 					= $offset;
		$data 	 						= Supplier::model()->findAll($crsp);

		$this->renderpartial('tampil_supplier',array('data'=>$data,'limit'=>$limit,'page'=>$page,'count'=>$halaman,'offset'=>$offset));
	}


	public function actiondelete_supplier()
	{	
		$id 		 			= $_POST['id'];
		$cr_item 				= new CDbCriteria;
		 $cr_item->condition 	= "no_id='".$id."'";
		 $sblmodel 				= Supplier::model()->find($cr_item);
		 $nama 					= $sblmodel->perusahaan;
				
		Supplier::model()->deleteAll($cr_item);
		$model 					= Supplier::model()->find($cr_item);

		if($model->no_id==''){
			echo ' Data Supplier '.$nama.' Berhasil Dihapus';
		}else{
			echo 'Gagal Menghapus Data Supplier '.$nama;
		}
				
	}


	public function actionedit_supplier()
	{	
		$id 		 		= $_POST['id'];
		$cr_item 			= new CDbCriteria;
		$cr_item->condition = "no_id= '".$id."'";
		$model 				= Supplier::model()->find($cr_item);
				
		$this->renderpartial('form_edit_supplier',array('model'=>$model));
	}

	public function actionupdate_supplier()
	{	
		$id_supplier 		= $_POST['id'];
		$supplier 			= $_POST['supplier'];
		$alamat 			= $_POST['alamat'];
		$telp 				= $_POST['telp'];
		$cr_id_kategori 	= new CDbCriteria;
		$cr_id_kategori 	= "no_id='".$id_supplier."'";

		$sbl 				= Supplier::model()->find($cr_id_kategori);

		Supplier::model()->updateAll(array('perusahaan'=>$supplier,'telp'=>$telp,'alamat'=>$alamat),$cr_id_kategori);

		$model 				= Supplier::model()->find($cr_id_kategori);

		if($model->perusahaan==$supplier){
			echo ' Data Supplier '.$sbl->perusahaan.' Berhasil di Edit';
		}else{
			echo 'Gagal Edit Supplier '.$model->perusahaan;
		}
	}

	public function actionsimpan_supplier()
	{	
		$kode 	= $_POST['kode'];
		$nama 	= $_POST['nama'];
		$alamat = $_POST['alamat'];
		$telp 	= $_POST['telp'];
		
		$cr_id 				= new CDbCriteria;
		$cr_id->condition 	= "no_id = '".$kode."'";
		$max_id 			= Supplier::model()->find($cr_id);
		
		if($max_id->no_id!=''){
			echo 'Kode Supplier sudah ada !';
		}else{
			$simpan_supplier 				= new Supplier;
			$simpan_supplier->no_id 		= $kode;
			$simpan_supplier->perusahaan	= $nama;
			$simpan_supplier->alamat		= $alamat;
			$simpan_supplier->telp 			= $telp;
			if($simpan_supplier->save()){
				echo ' Nama Supplier '.$nama.' Berhasil di Tambahkan';
			}else{
				echo ' Nama Supplier '.$nama.' Gagal di Tambahkan';
			}
		}	
		
	}

	public function actionmutasi()
	{	
		$modtoko 		= TbToko::model()->findAll();
		$this->render('mutasi_barang',array('modtoko'=>$modtoko));
	}

	public function actiontampil_barang()
	{
		$supplier 		= $_POST['supplier'];

		$cr_supplier 				=  new CDbCriteria;
		$cr_supplier->condition 	= "supplier='".$supplier."' and stok_gudang > 0";
		$barang 					= Barang::model()->findAll($cr_supplier);

		$this->renderpartial('tampil_daftar_barang',array('data'=>$barang,'supplier'=>$supplier));
	}

	public function actiontampil_tempmutasi()
	{
		 $toko 		= $_POST['toko'];
		 $user 		= $this->GetUserLogin();

		$cr_temp 				=  new CDbCriteria;
		$cr_temp->condition 	= "toko='".$toko."' and user='".$user."'";
		$barang 				= TempPindahbarang::model()->findAll($cr_temp);

		$this->renderpartial('tampil_temp_barang',array('data'=>$barang,'toko'=>$toko));
	}

	public function actionsimpan_tempmutasibarang()
	{
		$total_barang 	= $_POST['max_urut'];
		$toko 		 	= $_POST['toko'];
		$nota 			= date('dmYHis');

		for($i=1;$i<$total_barang;$i++){
			$kode_barang 	= $_POST['urut_'.$i];
			$stok_gudang 	= $_POST['stok_'.$i];
			$jumlah_mutasi 	= $_POST['jml_'.$i];
			if($jumlah_mutasi > 0){

				$cr_temp 			= new CDbCriteria;
				$cr_temp->condition = "kode='".$kode_barang."' and toko='".$toko."'";
				$cek_temporary 		= TempPindahbarang::model()->find($cr_temp);

				if($cek_temporary){
					$temp_jml 			= $cek_temporary->jml;
					$total_mutasi  		= $jumlah_mutasi+$temp_jml;	
					TempPindahbarang::model()->updateAll(array('jml'=>$total_mutasi),$cr_temp);

					$update_stok 			= $stok_gudang - $jumlah_mutasi;
					$cr_kode 				= new CDbCriteria;
					$cr_kode->condition 	= "kode='".$kode_barang."'";
					Barang::model()->updateAll(array('stok_gudang'=>$update_stok),$cr_kode);
				}else{
					$simpan 			= new TempPindahbarang;			
					$simpan->tgl 		= date('Y-m-d');			
					$simpan->kode 		= $kode_barang;			
					$simpan->jml 		= $jumlah_mutasi;			
					$simpan->barang		= $this->GetNamaItem($kode_barang);			
					$simpan->toko 		= $toko;			
					$simpan->user 		= $this->GetUserLogin();			
					$simpan->jam 		= date('H:i:s');			
					$simpan->alamat		= $this->GetAlamatToko($toko);			
					$simpan->telp 		= $this->GetTelpToko($toko);	
					$simpan->nota 		= date('His');			
					$simpan->h_jual		= $this->GetHargaItem($kode_barang);	
					if($simpan->save()){
						$update_stok 			= $stok_gudang - $jumlah_mutasi;
						$cr_kode 				= new CDbCriteria;
						$cr_kode->condition 	= "kode='".$kode_barang."'";
						Barang::model()->updateAll(array('stok_gudang'=>$update_stok),$cr_kode);
					}	
				}	
			}
		
		}
	}

	public function actionbatal_tempmutasibarang()
	{
		$toko 		 	= $_POST['toko'];
		$total_dimutasi	= $_POST['max_mutasi'];

		for($i=1;$i<$total_dimutasi;$i++){
			$kode_barang	= $_POST['batal_urut_'.$i];
			$batal_stok 	= $_POST['batal_stok_'.$i];
			$cr_del 			= new CDbCriteria;
			$cr_del->condition 	= "kode='".$kode_barang."'";

			$Barang 			= Barang::model()->find($cr_del);
			$stok_gudang 		= $Barang->stok_gudang;
			$update_stok 		= $stok_gudang+$batal_stok;

			Barang::model()->updateAll(array('stok_gudang'=>$update_stok),$cr_del);
			TempPindahbarang::model()->deleteAll($cr_del);
		}

	}

	public function actiondistribusikan()
	{
		$toko 		= $_POST['toko'];
		$username 	= $this->GetUserLogin();

		$cr_temp			= new CDbCriteria;
		$cr_temp->condition = "toko='".$toko."' and user='".$user."'";
		$TempMutasi 		= TempPindahbarang::model()->findAll($cr_temp);

		foreach($TempMutasi as $data){
			$cr_stok	 		= new CDbCriteria;
			$cr_stok->condition = "kode='".$data->kode."' and lokasi='".$toko."'";
			$stok_toko 			= StokToko::model()->find($cr_stok);
			$update_stok 		= $stok_toko + $data->jml;

			$cr_d 				= new CDbCriteria;
			$cr_d->condition	= "	kode='".$data->kode."' 
									and toko='".$data->toko."' 
									and user='".$username."'";

			if($stok_toko){
				$this->simpanrekapmutasi($data->kode,$toko);
				StokToko::model()->updateAll(array('stock_toko'=>$update_stok),$cr_stok);
				TempPindahbarang::model()->deleteAll($cr_d);
			}else{
				$simpan_stok 			= new StokToko;
				$simpan_stok->kode 		= $data->kode;
				$simpan_stok->lokasi	= $data->toko;
				if($simpan_stok->save()){
					$this->simpanrekapmutasi($data->kode,$toko);
					TempPindahbarang::model()->deleteAll($cr_d);
				}
			}
		}
	}

	public function actionsimpanrekapmutasi($kode,$toko)
	{
		$user 					= $this->GetUserLogin();
		$cr_mutasi 				= new CDbCriteria;
		$cr_mutasi->condition 	= "kode='".$kode."' and toko='".$toko."' and user='".$user."'";
		$temporary 				= TempPindahbarang::model()->find($cr_mutasi);

		if($temporary){
			$simpan_mutasi 				= new Mutasi;
			$simpan_mutasi->tgl 		= $temporary->tgl;			
			$simpan_mutasi->kode 		= $temporary->kode;			
			$simpan_mutasi->jml 		= $temporary->jml;			
			$simpan_mutasi->barang		= $temporary->barang;			
			$simpan_mutasi->toko 		= $temporary->toko;			
			$simpan_mutasi->user 		= $temporary->user;			
			$simpan_mutasi->jam 		= $temporary->jam;			
			$simpan_mutasi->alamat		= $temporary->alamat;			
			$simpan_mutasi->telp 		= $temporary->telp;	
			$simpan_mutasi->nota 		= $temporary->nota;			
			$simpan_mutasi->h_jual		= $temporary->h_jual;
			$simpan_mutasi->save();
		}
	}
	
} 