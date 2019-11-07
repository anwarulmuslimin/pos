<?php

class ProfilController extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
	}
	
	public function actionTampil_profil()
	{
		$id 					= $this->GetSekolahId();
		
		$cr_id 					= new CDbCriteria;
		$cr_id->condition 		= "pos_profil_sekolah_id='".$id."'";
		$profil_Sekolah 		= PosProfil::model()->find($cr_id);
		
		$this->renderpartial('form_profil',array('data'=>$profil_Sekolah));
		
	}

	public function actionEdit_profil()
	{
		$id 					= $_POST['id'];
		
		$cr_id 					= new CDbCriteria;
		$cr_id->condition 		= "pos_profil_sekolah_id='".$id."'";
		$profil_Sekolah 		= PosProfil::model()->find($cr_id);
		
		$this->renderpartial('form_profil',array('data'=>$profil_Sekolah,'mode'=>'edit'));
		
	}
	
	public function actionEdit_logo()
	{
		$id 					= $_POST['id'];
		
		$this->renderpartial('form_logo',array('id_sekolah'=>$id));
		
	}
	
	public function actionupload_logo()
	{
		$fileName = $_FILES['picture']['name'];
		$fileSize = $_FILES['picture']['size'];
		$fileError = $_FILES['picture']['error'];
		$success = false;

		if($fileSize > 0 || $fileError == 0){
			$move = move_uploaded_file($_FILES['picture']['tmp_name'], 'images/logo/'.$fileName); //Simpan ke folder images
			if($move){
				$success = true;

			session_start();
			$_SESSION['Namafile']=$fileName;

			}
		}
		
		if($success){
			$cr_logo 				= new CDbCriteria;
			$cr_logo->condition 	= "pos_profil_sekolah_id='".$this->GetSekolahId()."'";
			$update_logo 			= PosProfil::model()->find($cr_logo);
			
			if($update_logo->pos_profil_id != ""){
				$update_logo->pos_profil_logo 	= $fileName;
				$update_logo->save();
			}
			
		}
		$this->redirect(array('index'));
		
	}

	public function actionUpdate_profil()
	{
		$id 					= $_POST['id'];
		$idsekolah 				= $_POST['idsekolah'];
		$nama 					= $_POST['nama'];
		$alamat					= $_POST['alamat'];
		$telp 					= $_POST['telp'];
		
		$cr_id 					= new CDbCriteria;
		$cr_id->condition 		= "pos_profil_sekolah_id='".$id."'";
		$profil_Sekolah 		= PosProfil::model()->find($cr_id);
		
		if($profil_Sekolah->pos_profil_sekolah_id == $idsekolah){
			$profil_Sekolah->pos_profil_nama		= $nama;
			$profil_Sekolah->pos_profil_alamat		= $alamat;
			$profil_Sekolah->pos_profil_telp		= $telp;
			if($profil_Sekolah->save()){
				echo 'berhasil disimpan';
			}else{
				echo 'gagal disimpan';
			}
		}else{
			echo 'gagal disimpan';
		}	
	}

}