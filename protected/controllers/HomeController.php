<?php

class HomeController extends Controller
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
		session_start();
		if($_SESSION['status_login']==1){
			$this->redirect(array('home'));
		}
		$this->layout="login";
		$this->render('index');
	}
	
	public function actionLogin(){
		session_start();
		$username = $_POST['username'];
		$password = $_POST['password'];
		
		if($username=="" or $password==""){
			$this->redirect(array('index','kosong'=>1));
		}
		
		$crUser 			= new CDbCriteria;
		$crUser->condition 	= " user = '".$username."'";
		$cekUser 			= PosUser::model()->find($crUser);
		
		if($cekUser->user==$username){
		
		//$passMd5 = MD5($password);
		 
			if($cekUser->pass==$password){
					$_SESSION['id_login'] 			= $cekUser->id;
					$_SESSION['status_login'] 		= 1;
					$_SESSION['username_status'] 	= $cekUser->tipe_user;
					$_SESSION['username_login'] 	= $cekUser->user;
					$_SESSION['sekolah_idlogin'] 	= $cekUser->lokasi;				
				$this->redirect(array('home'));
			}else{
				$this->redirect(array('index','pass'=>1));
			}	
		}else{
			$this->redirect(array('index','user'=>1));
		}
	}
	
	public function actionhome()
	{	
		$date_now 					= date('Y-m-d');
		$lokasi 			 		= $this->GetSekolahId();
		$user_name 					= $this->GetUserLogin();

		if($this->GetStatusUser()=="Admin"){
			$cromset 					= new CDbCriteria;
			$cromset->select			= "sum(iTotal) as iTotal";
			$cromset->condition			= "	tgl='".$date_now."' 
											and lokasi='".$lokasi."'";
			$Omset 						= Item::model()->find($cromset);
			$RpOmset 					= $Omset->iTotal;

			$crlaris 			= new CDbCriteria;
			$crlaris->limit		= 4;
			$crlaris->group		= "iKodeBr";
			$crlaris->order		= "iJumlah DESC";
			$crlaris->select	= "sum(iJumlah) as iJumlah,iKodeBr";
			$ItemLaris			= Item::model()->findAll($crlaris);
		
			$this->render('home',array(
				'omset' 			=> $RpOmset,
				'ItemLaris' 		=> $ItemLaris,
	
			));	
		}else{
			$this->render('home_kasir');
		}
		
			
	}
	
	public function GetLabaBulan($bulan)
	{	
		$lokasi 			= $this->GetSekolahId();
		$user_name 			= $this->GetUserLogin();
		$year_now 			= date('Y');
		$bulan_now 			= date('m');
		if($bulan_now <= '05'){
			if($bulan >= '07'){
				$tahun 		= $year_now -1;
			}else{
				$tahun 		= $year_now;
			}
		}else{
			$tahun 		= $year_now;
		}
		
		$cr_laba 			= new CDbCriteria;
		$cr_laba->select	= "sum(iharga) as iharga,sum(ibeli) as ibeli,sum(iJumlah) as iJumlah";
		$cr_laba->group 	= "iKodeBr";
		$cr_laba->condition	= "	tgl between '".$tahun."-01-01' and '".$tahun."-".$bulan."-01'";  
		//$cr_laba->condition	= "	lokasi='".$lokasi."' and user='".$user_name."' and tgl between '".$year_now."-01-01' and '".$year_now."-".$bulan."-01' ";
		$Laba 				= Item::model()->findAll($cr_laba);	
		
		foreach($Laba as $laba){
			$h_jual 		= $laba->iharga*$laba->iJumlah;
			$h_beli 		= $laba->ibeli*$laba->iJumlah;

			$tot_jual 		= $tot_jual + $h_jual;
			$tot_beli 		= $tot_beli + $h_beli;
		}

		
	
		

		$hasil 				= $tot_jual-$tot_beli;
		
		return $hasil;
	}
	
	public function GetOmsetBulan($bulan)
	{	
		$sekolah_id 		= $this->GetSekolahId();
		$user_name 			= $this->GetUserLogin();
		$year_now 			= date('Y');
		$bulan_now 			= date('m');
		if($bulan_now <= '05'){
			if($bulan >= '07'){
				$tahun 		= $year_now -1;
			}else{
				$tahun 		= $year_now;
			}
		}else{
			$tahun 		= $year_now;
		}
		
		$cr_laba 			= new CDbCriteria;
		$cr_laba->select	= "sum(iTotal) as iTotal";
		$cr_laba->condition	= "	tgl between '".$tahun."-01-01' and '".$tahun."-".$bulan."-01'  ";
	//	$cr_laba->condition	= "	lokasi='".$sekolah_id."' and user='".$user_id."' and tgl between '".$year_now."-01-01' and '".$year_now."-".$bulan."-01'  ";
		$Laba 				= Item::model()->find($cr_laba);		
	
		if($Laba->iTotal==""){
			$hasil 				= 0;
		}else{
			$hasil 				= $Laba->iTotal;
		}
		
		return $hasil;
	}
	
	public function actiontampil_limit_item()
	{
		$id_sekolah 		= $_POST['id_sekolah'];
		
		$crlimit 			= new CDbCriteria;
		$crlimit->limit		= 20;
		$crlimit->order		= "pos_item_stok ASC";
		$LimitItem			= PosItem::model()->findAll($crlimit);
		
		$this->renderpartial('limit_stok',array('sekolah_id'=>$id_sekolah,'LimitItem'=>$LimitItem));		
	}
	public function actioncreate_casier()
	{
		
		$toko 				= $this->GetSekolahId();
		$this->render('form_create_casier',array('sekolah_id'=>$toko));		
	}
	
	public function actionview_user()
	{	
		$id_login 	 		= $this->GetUserId();
		$sekolah_id 		= $_POST['sekolah_id'];
		
		$cr_user 			= new CDbCriteria;
		$cr_user->order 	= "id ASC";
	 	$cr_user->condition = "lokasi='".$sekolah_id."'";
		$moduser 			= TbUser::model()->findAll($cr_user);
		
		$this->renderpartial('view_user',array('moduser'=>$moduser));
	}
	
	public function actionedit_user()
	{
		$pos_user_id 		= $_POST['pos_user_id'];
		$modedit_user 		= PosUser::model()->findbyPk($pos_user_id);
		$this->renderpartial('edit_user',array('modedit_user'=>$modedit_user));
	}
	
	public function actionadd_user()
	{
		$sekolah_id			= $_POST['sekolah_id'];
		$this->renderpartial('form_adduser',array('sekolah_id'=>$sekolah_id));
	}
	
	public function actionsimpan_user()
	{
		$sekolah_id			= $_POST['sekolah_id'];
		$username 	 		= $_POST['username'];
		$password 	 		= MD5($_POST['password']);
		$konfirmasi	 		= MD5($_POST['konfirmasi']);
		
		$cr_id 				= new CDbCriteria;
		$cr_id->order 		= "id DESC";
		$urut_user 			= TbUser::model()->find($cr_id);
		if($urut_user->pos_user_id!==""){
			$max_user 		= $urut_user->id+1;
		}else{
			$max_user 		= 1;
		}
		if($password==$konfirmasi){
			$simpan_user 			= new TbUser;
			$simpan_user->id		= $max_user;
			$simpan_user->lokasi	= $sekolah_id;
			$simpan_user->user		= $username;
			$simpan_user->pass		= $_POST['password'];
			$simpan_user->tipe_user	= 'kasir';
			if($simpan_user->save()){
				echo 'simpan user berhasil.';
			}else{
				echo 'simpan user gagal';
			}		
			
		}else{
			echo 'simpan user gagal';
		}
	}
	
	public function actiondelete_user()
	{
		 $pos_user_id 		= $_POST['id'];
		 $cr_id 			= new CDbCriteria;
		 $cr_id->condition 	= "id='".$pos_user_id."'";

		 TbUser::model()->deleteAll($cr_id);
	}
		
	public function actionupdate_user()
	{
		$pos_user_id 		= $_POST['id'];
		$username 	 		= $_POST['username'];
		$password 	 		= MD5($_POST['password']);
		$konfirmasi	 		= MD5($_POST['konfirmasi']);
		if($password==$konfirmasi){
			TbUser::model()->updateByPk($pos_user_id,array('user'=>$username,'pass'=>$password));
			echo 'update berhasil.';
		}else{
			echo 'update gagal';
		}
	}
	
	public function actionchange_password()
	{	
		session_start();
		$id_login 	 		= $_SESSION['id_login'];
		$status 	 		= $_GET['status'];
		$modganti_password	= TbUser::model()->findbyPk($id_login);
		$this->render('ganti_password',array('modganti_password'=>$modganti_password,'status'=>$status));
	}
	
	public function actionupdatepassword()
	{	
		$pos_user_id 		= $_POST['pos_user_id'];
		$username 	 		= $_POST['edit_username'];
		 $password 	 		= MD5($_POST['edit_password']);
		$konfirmasi	 		= MD5($_POST['konfirmasi_password']);
		if($password==$konfirmasi){
			PosUser::model()->updateByPk($pos_user_id,array('pos_user_username'=>$username,'pos_user_password'=>$password));
			$status = 'update password berhasil.';
		}else{
			$status = 'update password gagal.';
		}
		$this->redirect(array('change_password','status'=>$status));
	}
	
	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
	    if($error=Yii::app()->errorHandler->error)
	    {
	    	if(Yii::app()->request->isAjaxRequest)
	    		echo $error['message'];
	    	else
	        	$this->render('error', $error);
	    }
	}
 
	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$headers="From: {$model->email}\r\nReply-To: {$model->email}";
				mail(Yii::app()->params['adminEmail'],$model->subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
	
}
