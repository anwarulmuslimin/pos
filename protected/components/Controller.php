<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to 'column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/column1';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();
	
	public function CekLogin()
	{				
	//	session_start();
	//	if($_SESSION['status_login']<>1){
	//		$this->redirect(array('home/index'));
		//}		
	}
	
	public function GetNamaKategori($id)
	{
		$cr_kategori 				= new CDbCriteria;
		$cr_kategori->condition 	= "pos_kategori_id='".$id."'";
		$kategori 					= PosKategori::model()->find($cr_kategori);
		$hasil 						= $kategori->pos_kategori_nama;
		
		return $hasil;
	}


	public function GetStatusNamaKategori($id)
	{
		$cr_kategori 				= new CDbCriteria;
		$cr_kategori->condition 	= "pos_kategori_id='".$id."' and pos_kategori_status='1'";
		$kategori 					= PosKategori::model()->find($cr_kategori);
		$hasil 						= $kategori->pos_kategori_id;
		
		return $hasil;
	}
	
	public function GetHargaItem($id)
	{
		$cr_item 	 				= new CDbCriteria;
		$cr_item->condition 		= "kode='".$id."'";
		$Item 	 					= Barang::model()->find($cr_item);
	 	$hasil 						= $Item->h_jual;
		
		return $hasil;
	}
	
	public function GetStokItem($id)
	{
		$cr_item 	 				= new CDbCriteria;
		$cr_item->condition 		= "kode='".$id."'";
		$Item 	 					= Barang::model()->find($cr_item);
		$hasil 						= $Item->stock_toko;
		
		return $hasil;
	}

	public function GetCariSupplierbarang($id)
	{
		$cr_item 	 				= new CDbCriteria;
		$cr_item->condition 		= "kode='".$id."'";
		$Item 	 					= Barang::model()->find($cr_item);
		$hasil 						= $Item->supplier;
		
		return $hasil;
	}
	
	public function GetHargaModal($id)
	{
		$cr_item 	 				= new CDbCriteria;
		$cr_item->condition 		= "kode='".$id."'";
		$Item 	 					= Barang::model()->find($cr_item);
		$hasil 						= $Item->h_beli;
		
		return $hasil;
	}
	
	public function GetNamaItem($id)
	{
		$cr_item 	 				= new CDbCriteria;
		$cr_item->condition 		= "kode='".$id."'";
		$Item 	 					= Barang::model()->find($cr_item);
		$hasil 						= $Item->nama_barang;
		
		return $hasil;
	}
	
	public function GetKategoriItem($id)
	{
		$cr_kategori_item				= new CDbCriteria;
		$cr_kategori_item->condition 	= "kode='".$id."'";
		$KategoriItem 	 				= Barang::model()->find($cr_kategori_item);
		$hasil 							= $KategoriItem->katagori;
		
		return $hasil;
	}


	public function GetJenisItem($id)
	{
		$cr_kategori_item				= new CDbCriteria;
		$cr_kategori_item->condition 	= "kode='".$id."'";
		$KategoriItem 	 				= Barang::model()->find($cr_kategori_item);
		$hasil 							= $KategoriItem->jenis;
		
		return $hasil;
	}


	public function HargaDiskon($kode,$lokasi)
	{
		$harga_item     = $this->GetHargaItem($kode);

		$cr 			= new CDbCriteria;
		$cr->condition 	= "kode=".$kode." and lokasi=".$lokasi."";
		$TmpDiskon 		= TempDiskon::model()->find($cr);
		
		if($TmpDiskon){

			$nom_diskon_1   = $TmpDiskon->nominal;
			$nom_diskon_2   = $TmpDiskon->nominal_2;
			$total_diskon   = $nom_diskon_1+$nom_diskon_2;
			$hasil   		= $total_diskon;

		}else{
			$hasil 			= 0;
		}

		
		return $hasil;
	}
	
	public function GetSekolahId()
	{
		session_start();
		$sekolah_id 			= $_SESSION['sekolah_idlogin'];
		
		return $sekolah_id;
	}


	public function GetNamaSupplier($id)
	{
		$crid 				= new CDbCriteria;
		$crid->condition 	= "no_id = '".$id."'";
		$suppl 				= Supplier::model()->find($crid);

		$nama_supplier		= $suppl->perusahaan;
		
		return $nama_supplier;
	}

	public function GetNamaToko($id)
	{
		$cr_toko 			= new CDbCriteria;
		$cr_toko->condition = "no_id = '".$id."'";
		$toko 				= TbToko::model()->find($cr_toko);

		$nama_toko 			= $toko->toko;
		
		return $nama_toko;
	}

	public function GetAlamatToko($id)
	{
		$cr_toko 			= new CDbCriteria;
		$cr_toko->condition = "no_id = '".$id."'";
		$toko 				= TbToko::model()->find($cr_toko);

		$alamat 			= $toko->alamat;
		
		return $alamat;
	}


	public function GetTelpToko($id)
	{
		$cr_toko 			= new CDbCriteria;
		$cr_toko->condition = "no_id = '".$id."'";
		$toko 				= TbToko::model()->find($cr_toko);

		$telp 				= $toko->telp;
		
		return $telp;
	}

	public function GetStatusUser()
	{
		session_start();
		$status_user 			= $_SESSION['username_status'];
		
		return $status_user;
	}

	public function GetUserLogin()
	{
		session_start();
		$username 			= $_SESSION['username_login'];
		
		return $username;
	}

	public function GetUserId()
	{
		session_start();
		$id_login 			= $_SESSION['id_login'];
		
		return $id_login;
	}
	
	public function GetNamaUser($id)
	{	
		$cr_user 					= new CDbCriteria;
		$cr_user->condition 		= "pos_user_id='".$id."'";
		$User 	 					= PosUser::model()->find($cr_user);
		$hasil 						= $User->pos_user_username;
		
		return $hasil;
	}
	
	public function Uang($angka)
	{
		$hasil =number_format($angka,0,',','.'); 
		return $hasil;
	}

	public function left($str, $length) {
		return substr($str, 0, $length);
   }

   public function right($str, $length) {
		return substr($str, -$length);
   }
	
	public function NewNota()
	{
		$today			= date('dmY');
		//$tanggal		= date('d');
		// 03082015
		// 0001

		//$format			= $today;
		$cr				= new CDbCriteria;
		$cr->order		= "iNonota DESC";
		$cr->condition	= "iNonota like'".$today."%'";
		$kwitansi		= Item::model()->find($cr);

		$nota			= $kwitansi->iNonota;
		if($nota<>""){
			$nobukti		= $this->right($nota,4) + 1;

			if(strlen($nobukti) < 4){
				$Urut = str_pad($nobukti, 4, "0", STR_PAD_LEFT);
			}else{
				$Urut = $nobukti;
			}

            $nobukti = $today.$Urut;

		}else{
			$nobukti		= $today.'000000001';
		}

		return $nobukti;
	}
	
	public function CreatePaging($page,$count=0,$limit=5,$ajax='refresdaftar',$select=true){
		if($count>1){
			$html = '<div class="box-tools">
				<ul class="pagination pagination-sm no-margin pull-right">
					<li><a id="Previous" href="javascript::Previous">Previous</a></li>
						<script type="text/javascript">
							$("#Previous").click(function(){
								'.$ajax.'('.($page-1).',$("#limit").val());
							});
						</script>';
					for($i=1;$i<=$count;$i++){
						if($page==$i){ $aktif= 'class="active"';}else{ $aktif= ' ';}

							if ((($i >= $page - 3) && ($i <= $page + 3)) || ($i == 1) || ($i == $count))
							{
								$html.= '<li style="cursor:pointer;" '.$aktif.' ><a href="javascript::halaman'.$i.'" id="page'.$i.'">';
									if($i==1 && $page!=$i){
										$html.='First ';
									}elseif($i==$count && $page!=$i){
										$html.='last ';
									}else{
										$html.=$i;
									}
								$html.= '</a></li>
								<script type="text/javascript">
									$("#page'.$i.'").click(function(){
										'.$ajax.'('.$i.',$("#limit").val());
									});
								</script>';

								$showPage = $i;
							}

					}
					 $html.= '<li><a id="Next" href="javascript::Next">Next</a></li>
						<script type="text/javascript">
							$("#Next").click(function(){
								'.$ajax.'('.($page+1).',$("#limit").val());
							});
						</script>
				</ul>
			</div>';
		}
		if($select==true){
			$html.= '<label>Tampilkan '.$limit.' : </label><select id="limit" class="span1">';
				for($j=1;$j<=50;$j++){
					if($limit==$j){ $selected = 'selected';}else{$selected = '';}
					if(($j%5)==0){
						$html.= '<option '.$selected.' value="'.$j.'">'.$j.'</option>';
					}
				}
			$html.= '</select>
			<script type="text/javascript">
				$("#limit").change(function(){
					'.$ajax.'(1,$("#limit").val());
				});
			</script>';
		}
		return $html;
	}
	
	public function GetNamaBulan($bulan)
	{
		switch($bulan){
	        case 1 : {
	                    $bulannama='Januari';
	                }break;
	        case 1 : {
	                    $bulannama='Januari';
	                }break;
	        case 1 : {
	                    $bulannama='Januari';
	                }break;
	        case 1 : {
	                    $bulannama='Januari';
	                }break;
	        case 1 : {
	                    $bulannama='Januari';
	                }break;
	        case 2 : {
	                    $bulannama='Februari';
	                }break;
	        case 3 : {
	                   $bulannama='Maret';
	                }break;
	        case 4 : {
	                   $bulannama='April';
	                }break;
	        case 5 : {
	                   $bulannama='Mei';
	                }break;
	        case 6 : {
	                   $bulannama="Juni";
	                }break;
	        case 7 : {
	                   $bulannama='Juli';
	                }break;
	        case 8 : {
	                   $bulannama='Agustus';
	                }break;
	        case 9 : {
	                   $bulannama='September';
	                }break;
	        case 10 : {
	                   $bulannama='Oktober';
	                }break;
	        case 11 : {
	                   $bulannama='November';
	                }break;
	        case 12 : {
	                   $bulannama='Desember';
	                }break;
	    }
		return $bulannama;
	}

	public function ceksaldotcash($notcash,$nominal,$status)
	{
		$status 	= 'true';
		return $status;
	}

	public function GetNoJurnal()
	{
		$Nojurnal_Awal = "JU0000000001";

		$kriteria_max 			= new CDbCriteria;
		$kriteria_max->order 	= "NoJurnal DESC";
		$MaxJurnal 				= Siajurnal::model()->find($kriteria_max);

		if($MaxJurnal->NoJurnal<>""){

			$cr_max 				= new CDbCriteria;
			$cr_max->condition 		= "NoJurnal ='".$MaxJurnal->NoJurnal."'";
			$Max_Jurnal 			= Siajurnal::model()->find($cr_max);
			if($Max_Jurnal->NoJurnal<>""){

				$Kanan = strlen($Max_Jurnal->NoJurnal) - 2;

				$J = (substr($Max_Jurnal->NoJurnal, - $Kanan)) + 1;

				If(strlen($J) < 5){
					$Urut = str_pad($J, 6, "0", STR_PAD_LEFT);
				}Else{
					$Urut = $J;
				}

                $No_Urut_Jurnal = "JU".$Urut;

				return $No_Urut_Jurnal;

			}else{
				return $Nojurnal_Awal;
			}
		}else{
			return $Nojurnal_Awal;
		}
	}	
}