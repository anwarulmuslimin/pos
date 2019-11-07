<?php

class TransaksiController extends Controller
{	
	protected function beforeAction($action)
    {
       $this->CekLogin();
	   return true;
    }	
	 
	public function actionIndex()
	{		
		$lokasi 			 		= $this->GetSekolahId();
		$cr_k 		 			= new CDbCriteria;
		$cr_k->condition 		= "idtoko=$lokasi";		
		$cek_temp	 			= TempPenjualan::model()->findAll($cr_k);
						
		$this->render('index',array(
			'cek_temp'		=> $cek_temp,
			'toko'			=> $lokasi,
			));
	}
	 
	public function actiontransaksi_temp()
	{
		$toko 										= $_POST['toko'];
		$id_item 									= $_POST['kode_item'];
		$jml 	 									= $_POST['jml_item'];
		
		$cr_item1 									=  new CDbCriteria;
		$cr_item1->condition						=  "kode='".$id_item."'";
		$model_item 								= Barang::model()->find($cr_item1);

		$cr_stok 									= new CDbCriteria;
		$cr_stok->condition							= "kode='".$id_item."' and lokasi='".$toko."'";
		$modStoktoko 								= StokToko::model()->find($cr_stok);

		$hitung_stok 								= $modStoktoko->stock_toko;
		$harga_jual 								= $model_item->h_jual;
		
		if($jml == "" or $jml=="undefinied"){
			$kali_jumlah 							= 1;
		}else{
			$kali_jumlah 							= $jml;
		}
		
		$cr_id_temp 								= new CDbCriteria;
		$cr_id_temp->order  						= "id DESC";
		$max_transaksi_temp 						= TempPenjualan::model()->find($cr_id_temp);
		
		if($max_transaksi_temp->id!=''){
			$id_temp 								= $max_transaksi_temp->id +1;
		}else{
			$id_temp 								= 1;
		}
		$tanggal 									= date('Y-m-d');
		$cr_item 	 								= new CDbCriteria;
		$cr_item->condition 						= "	kd_barang ='".$id_item."' 
														and idtoko ='".$toko."'
														and tanggal ='".$tanggal."' ";
		$mod_itemtransaksi  						= TempPenjualan::model()->find($cr_item);
		$jml_temp_transaksi 						= $mod_itemtransaksi->jumlah;
	
		if($mod_itemtransaksi->kd_barang == $id_item){
			$total_jml_beli 							= $kali_jumlah + $jml_temp_transaksi;
			if($hitung_stok<=$total_jml_beli){
				$jml_beli 								= $hitung_stok;
			}else{
				$jml_beli 								= $total_jml_beli;
			}
			$mod_itemtransaksi->jumlah 	= $jml_beli;
			if($mod_itemtransaksi->save()){
				$update_stok 							= $hitung_stok - $jml;
				Barang::model()->updateAll(array('stock_toko'=>$update_stok),$cr_item1);
			}
		}else{
			if($hitung_stok<=$kali_jumlah){
				$jml_beli 								= $hitung_stok;
			}else{
				$jml_beli 								= $kali_jumlah;
			}
		
			$simpan_item 								= new TempPenjualan;
			$simpan_item->id 					 		= $id_temp;
			$simpan_item->idtoko 						= $toko;
			$simpan_item->kd_barang 					= $id_item;
		 	$simpan_item->jumlah 					 	= $jml_beli;
		 	$simpan_item->tanggal 					 	= $tanggal;
			if($simpan_item->save()){
				$update_stok 							= $hitung_stok - $jml_beli;
				StokToko::model()->updateAll(array('stock_toko'=>$update_stok),$cr_stok);
			}
		}
	}
	
	public function actionviewtemp()
	{
		$toko			 							= $_POST['toko'];
		$cr_transaksi_tmp 							= new CDbCriteria;
		$cr_transaksi_tmp->condition 				= "idtoko='".$toko."'";
		$transaksi_temp 							= TempPenjualan::model()->findAll($cr_transaksi_tmp);
		
		$this->renderpartial('tampil_transaksi_temp',array('transaksi_temp'=>$transaksi_temp));
	}
	
	public function actionhapus_temp()
	{ 
		$id 				= $_POST['id'];
	 	$jml 				= $_POST['jml'];
	 	$kode 				= $_POST['kode'];
		
		$cr_temp 									= new CDbCriteria;
		$cr_temp->condition 						= "id=$id";
		$transaksi_temp 							= TempPenjualan::model()->find($cr_temp);
		
		$cr_item 									=  new CDbCriteria;
		$cr_item->condition							=  "kode='".$kode."'";
		$model_item 								= Barang::model()->find($cr_item);		
		 $hitung_stok 								= $model_item->stock_toko;
		 
		 $cr_Stok 									= new CDbCriteria;
		 $cr_Stok->condition 						= "kode='".$kode."' and lokasi='".$this->GetSekolahId()."'";
		
		$update_stok 								= $hitung_stok + $jml;
		StokToko::model()->updateAll(array('stock_toko'=>$update_stok),$cr_Stok);
		if($transaksi_temp){
			$transaksi_temp->delete();
		}
	}
	
	public function actionedit_jumlah_beli()
	{
		$id 										= $_POST['id'];
		
		$cr_id 										= new CDbCriteria;
		$cr_id->condition 							= "id=$id";
		$form_update 								= TempPenjualan::model()->find($cr_id);
		
		$this->renderpartial('form_update_jml',array('form_update'=>$form_update));
	}
	
	public function actiontampil_list_belanja(){
		$konsumen 		= $_POST['konsumen'];
		
		$cr_beli 			= new CDbCriteria;
		$cr_beli->condition = "pos_transaksi_temp_konsumen='".$konsumen."'";
		$looping_pembelian 	= PosTransaksiTemp::model()->findAll($cr_beli);
		
		$this->renderpartial('list_belanja_konsumen',array('looping_pembelian'=>$looping_pembelian));
	}
	
	public function actionupdate_jumlah_beli()
	{
		$id 										= $_POST['id'];
		$jml 										= $_POST['jml'];
		$jml_a 										= $_POST['jml_a'];
		$selisih_edit 								= $jml_a - $jml;
		$modata		 								= TempPenjualan::model()->findByPk($id);

		$cr_item 	 								= new CDbCriteria;
		$cr_item->condition 						= "kode='".$modata->kd_barang."'";
		$Item 	 									= Barang::model()->find($cr_item);
		
		$hitung_stok 								= $Item->stock_toko;
		$harga_satuan 								= $Item->h_jual;
		$update_total 								= $harga_satuan * $jml;
			
		
		$update_stok 								= $hitung_stok + $selisih_edit;
		Barang::model()->updateAll(array('stock_toko'=>$update_stok),$cr_item);		
		TempPenjualan::model()->updateByPk($id,array('jumlah'=>$jml));
	}
	
	public function actiontotal_bayar()
	{
		$toko 				= $_POST['toko'];
		$cr_trx 			= new CDbCriteria;
		$cr_trx->condition  = "idtoko='".$toko."'";
		$model_transaksi 	= TempPenjualan::model()->findAll($cr_trx);

		foreach($model_transaksi as $data){
			$cr_item 	 		= new CDbCriteria;
			$cr_item->condition = "kode='".$data->kd_barang."'";
			$Barang 			= Barang::model()->find($cr_item);

			$nominal_diskon 	= $this->HargaDiskon($data->kd_barang,$data->idtoko);
			$harga_barang 		= ($Barang->h_jual*$data->jumlah)-($nominal_diskon*$data->jumlah);
			
			$jml_harga 			= $jml_harga + $harga_barang;
		}
		echo "<input type='hidden' name='wajib_bayar' id='wajib_bayar' value='".$jml_harga."'>";
		echo "Rp ".$this->Uang($jml_harga);
	}
	
	public function actionproses_bayar()
	{ 
		Yii::import('application.exstensions.fungsi.*'); 	
		
		require_once("SimpanJurnal.php"); 					
		require_once("GetTokojenis.php"); 					
		require_once("SimpanRincianBayar.php"); 			

		$transaction 										= Yii::app()->db->beginTransaction();
		
		try
		{
			$jmlbayar										= $_POST['jmlbayar'];
			$nomnalbayar									= $_POST['nomnalbayar'];
			$toko 											= $this->GetSekolahId();
			$nonota 										= $this->NewNota();
			$tanggal 										= date('Y-m-d');
			$uraian 										= 'Penjualan';
			$Petugas 										= $this->GetUserLogin();
			
			$cr_dibayar 									= new CDbCriteria;
			$cr_dibayar->condition 							= "idtoko='".$toko."'";
			$mod_trx										= TempPenjualan::model()->findAll($cr_dibayar);

			foreach($mod_trx as $mod_trx){

				$cr_barang 										= new CDbCriteria;
				$cr_barang->condition 							= "kode='".$mod_trx->kd_barang."'";
				$barang 										= Barang::model()->find($cr_barang);

				$kode_barang 									= $barang->kode;
				$jumlah_barang 									= $mod_trx->jumlah;
				$kategori 	 									= $barang->katagori;
				$KodeSuplier 									= $barang->supplier;
				$HargaBeli 	 									= $barang->h_beli;
				$HargaJual 	 									= $barang->h_jual;

			//	$GetTokojenis 									= new GetTokojenis; 
			//	$GetTokojenis->Kode_GetToko($toko);
				
			//	$AkunDebet 										= $GetTokojenis->GetKode_PENDAPATAN();
			//	$AkunKredit 									= $GetTokojenis->GetKode_BB();
			//	$NoJurnal 										= $this->GetNoJurnal(); 

			//	$SimpanJurnal = new SimpanJurnal($tanggal,$nonota,$NoJurnal,$uraian,$toko); 
				//$SimpanJurnal->SimpanSiaJurnal();
			
			//	$SimpanJurnal->SimpanSiaDetailJurnal($AkunDebet,$HargaJual,"Debit");
				//$SimpanJurnal->SimpanSiaDetailJurnal($AkunKredit,$HargaJual,"Kredit");
				$nominal_diskon = $this->HargaDiskon($kode_barang,$toko);
				$Diskon 		= $nominal_diskon*$jumlah_barang;
				$kode_toko 		= $toko;
				$SimpanRincian 	= new SimpanRincianBayar($tanggal,$nonota,$Petugas,$kode_toko,$Diskon);
				$SimpanRincian->SimpanDbyr($kode_barang,$HargaJual,$jumlah_barang,$kategori,$KodeSuplier,$HargaBeli);
				
			}
				$SimpanRincian->SimpanByr('0',$nomnalbayar);

				TempPenjualan::model()->deleteAll($cr_dibayar);
				$transaction->commit();
		}
		catch(Exception $e) /* an exception is raised if a query fails */
		{
			$transaction->rollback();
			echo $e;
		}

		$cr_kw 					= new CDbCriteria;
		$cr_kw->condition 		= "iNonota='".$nonota."'";
		$kwitansi_pos 			= Item::model()->findAll($cr_kw);
		
		$this->renderpartial('kwitansi',array('kwitansi_pos'=>$kwitansi_pos,'UangCash'=>$jmlbayar));
	}
	
	public function actioncari_item_beli(){
		$cari_item 					= $_POST['cari_item'];
		
		$cr_item 					= new CDbCriteria;
		$cr_item->condition 		= "stock_toko > 0 and (nama_barang like '%".$cari_item."%' or kode like '%".$cari_item."%')";
		$tampil_item 				= Barang::model()->findAll($cr_item);
		
		$this->renderpartial('tampil_daftar_pencarian',array('data'=>$tampil_item));
	}
		
	public function actionremove_bayar(){
		$konsumen 				= $_POST['urutan_konsumen'];
		
		$cr_remove	 			= new CDbCriteria;
		$cr_remove->condition 	= "pos_transaksi_temp_konsumen='".$konsumen."'";
		$transaksi_temp 		= PosTransaksiTemp::model()->findAll($cr_remove);
		
		foreach($transaksi_temp as $transaksi_temp){
			
			$cr_item 									=  new CDbCriteria;
			$cr_item->condition							=  "pos_item_id='".$transaksi_temp->pos_transaksi_temp_item_id."'";
			$model_item 								= PosItem::model()->find($cr_item);		
			$hitung_stok 								= $model_item->pos_item_stok;
			$update_stok 								= $hitung_stok + $transaksi_temp->pos_transaksi_temp_jumlah;
			
			PosItem::model()->updateAll(array('pos_item_stok'=>$update_stok),$cr_item);	
			
		}
		
		PosTransaksiTemp::model()->deleteAll($cr_remove);
		
	}
		
	
	
	public function actioncari()
	{
		 $term = $_GET['PostalCode'];
		 //$term = 'damar';
		 $nama = strtolower($term);

		 $users = PosItem::model()->findAll(array(
		        'condition' => 'lower(pos_item_nama) LIKE :pos_item_nama',
		        'params' => array(
		        ':pos_item_nama' => "%$nama%",
		        ),
		        ));
		  $return = array();
		  foreach ($users as $user) {
		        $return[] = trim($user->pos_item_nama);
		    }
		    echo CJSON::encode($return);
	}
	public function actioncari2()
	{
		$keyword = strval($_POST['query']);		
		$cr_search 				= new CDbCriteria;
		$cr_search->condition 	= "pos_item_nama like'%".$keyword."%'";
		$positem 				= PosItem()->findAll($cr_search);
		
		foreach($positem as $positem){
			$countryResult[] = $positem->pos_item_nama;
		}
		
		echo json_encode($countryResult);
	}
	
	public function actioncari_transaksi()
	{
		$keyword = strval($_POST['query']);
		$search_param = "{$keyword}%";
		$conn =new mysqli('localhost', 'root', 'rahasia' , 'blog_samples');

		$sql = $conn->prepare("SELECT * FROM tbl_country WHERE country_name LIKE ?");
		$sql->bind_param("s",$search_param);			
		$sql->execute();
		$result = $sql->get_result();
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
			$countryResult[] = $row["country_name"];
			}
			echo json_encode($countryResult);
		}
		$conn->close();
	}
	
	public function actioncari3()
	{
		$search 	= $_GET['term'];
		
		$cr_search 				= new CDbCriteria;
		$cr_search->condition 	= "pos_item_nama like'%".$search."%'";
		$positem 				= PosItem::model()->findAll($cr_search);
		
		foreach($positem as $positem){
			$row_set[] = $positem->pos_item_nama;
		}
			 
		echo json_encode($row_set);
	}
	
	public function actiontampil_belanja()
	{
		$id_item 				= $_POST['id_item'];
		$cr_search 				= new CDbCriteria;
		$cr_search->condition 	= "kode ='".$id_item."' ";
		$positem 				= Barang::model()->find($cr_search);
		$this->renderpartial('transaksi',array('data'=>$positem));
	}

	public function actionpembelian()
	{
		$this->render('pembelian');
	}

	public function actionlihat_pembelian()
	{
		$supplier 		= $_POST['supplier'];
		$nonota  		= $_POST['nofaktur'];

		$cr_daft			= new CDbCriteria;
		$cr_daft->condition = "suplier='".$supplier."' and nota = '".$nonota."'";
		$pembelian 			= PembelianTemp::model()->findAll($cr_daft);

		$this->renderpartial('tampil_pembelian',array('pembelian'=>$pembelian));
	}

	public function actionsimpan_pembelian()
	{
		$suplier 		= $_POST['suplier'];
		$faktur  		= $_POST['faktur'];
		$tanggal  		= $_POST['tanggal'];
		$kode  			= $_POST['kode'];
		$nama   		= $_POST['barang'];
		$harga 			= $_POST['harga'];
		$jml  			= $_POST['jml'];

		$simpan_temp 				= new PembelianTemp;
		$simpan_temp->kode 			= $kode;
		$simpan_temp->tgl 			= $tanggal;
		$simpan_temp->barang		= $nama;
		$simpan_temp->harga			= $harga;
		$simpan_temp->suplier		= $suplier;
		$simpan_temp->jumlah		= $jml;
		$simpan_temp->user 			= $this->GetUserLogin();
		$simpan_temp->jam 			= date('H:i:s');
		$simpan_temp->nama_suplier	= $this->GetNamaSupplier($suplier);
		$simpan_temp->nota  		= $faktur;
		$simpan_temp->save();
	}
	
	public function actionbatalpembelian()
	{
		$kode 				= $_POST['kode'];

		$cr_del 			= new CDbCriteria;
		$cr_del->condition  = "kode='".$kode."'";

		PembelianTemp::model()->deleteAll($cr_del);
	}

	public function actionretur()
	{
		// nilai 1 adalah retur penjualan
		// nilai 2 adalah retur pembelian
		$jenis_retur 		= $_GET['id'];

		if($jenis_retur==1){
			$render 		= 'tampil_retur_penjualan';
		}elseif($jenis_retur==2){
			$render 		= 'tampil_retur_pembelian';
		}
		$this->render($render);
		
	}

	public function actiontampildaftar_retur()
	{
		$toko 	 = $_POST['toko'];

		$cr_toko 			= new CDbCriteria;
		$cr_toko->condition = "lokasi='".$toko."'";
		$retur_penjualan 	= Returpenjualan::model()->findAll($cr_toko);

		$this->renderpartial('tampildaftar_retur',array('data'=>$retur_penjualan));
	}

	public function actionsimpan_returjual()
	{
		$toko 	 		= $_POST['toko'];
		$faktur  		= $_POST['faktur'];
		$tanggal  		= $_POST['tanggal'];
		$kode  			= $_POST['kode'];
		$nama   		= $_POST['barang'];
		$alasan			= $_POST['alasan'];
		$jml  			= $_POST['jml'];

		$simpan_retur 				= new Returpenjualan;
		$simpan_retur->kode 		= $kode;
		$simpan_retur->tgl  		= $tanggal;
		$simpan_retur->nota 		= $faktur;
		$simpan_retur->lokasi 		= $toko;
		$simpan_retur->alasan 		= $alasan;
		$simpan_retur->nama_barang	= $nama;
		$simpan_retur->jml  		= $jml;
		$simpan_retur->save();

	}

	public function actioncari_nama_barang()
	{
		$kode 	 = $_POST['kode'];
		$toko 	 = $_POST['toko'];

		$cek_stok 		 		= new CDbCriteria;
		$cek_stok->condition 	= "kode='".$kode."' and lokasi='".$toko."'";
		$StokToko 				= StokToko::model()->find($cek_stok);

		//if($StokToko->stock_toko > 0){
			echo $this->GetNamaItem($kode);
	//	}

		
	}

	public function actionbatal_returjual()
	{
		$kode 				= $_POST['kode'];
		$toko 				= $_POST['toko'];

		$cr_del 			= new CDbCriteria;
		$cr_del->condition  = "kode='".$kode."' and lokasi='".$toko."'";

		Returpenjualan::model()->deleteAll($cr_del);
	}

	public function actionproses_returpenjualan()
	{
		$toko 		= $_POST['toko'];
		$total 		= $_POST['total_urut'];

		for($i=1;$i< $total;$i++){
			$kode 	= $_POST['pilih_'.$i];
		
			$crk 			= new CDbCriteria;
			$crk->condition = "kode='".$kode."' and lokasi='".$toko."'";
			$modretur		= Returpenjualan::model()->find($crk);

			if($modretur){
		
				$cr_search	 			= new CDbCriteria;
				$cr_search->condition 	= "nota='".$modretur->nota."' and kode='".$kode."' and tgl='".$modretur->tgl."'";
				$cek_retur 				= Returnbarangtemp::model()->find($cr_search);

				if($cek_retur){
						// sudah diretur
				}else{
					$simpankan 				= new Returnbarangtemp;
					$simpankan->kode 		= $kode;
					$simpankan->tgl 		= $modretur->tgl;
					$simpankan->jml 		= $modretur->jml;
					$simpankan->alasan 		= $modretur->alasan;
					$simpankan->Supplier	= $this->GetCariSupplierbarang($kode);
					$simpankan->nama_barang	= $modretur->nama_barang;
					$simpankan->nota 		= $modretur->nota;
					$simpankan->save();
				}
			}
		}

	}

	public function actiondaftar_returpembelian()
	{
		$supplier 	= $_POST['supplier'];

		$cr_supplier 			= new CDbCriteria;
		if($supplier!=''){
		$cr_supplier->condition = "Supplier='".$supplier."'";}
		$modsupplier 			= Returnbarangtemp::model()->findAll($cr_supplier);

		$this->renderpartial('tampil_daftar_tempretur',array('modal'=>$modsupplier));
	}
	
	
}