<?php
class SimpanJurnal
{
	var $Tanggal;
	var $NoBukti;
	var $NoJurnal;
	var $Uraian;
	var $KodeAkun;
	var $Nominal;
	var $Group;
		
	function __construct($Tanggal,$NoBukti,$NoJurnal,$Uraian,$Group)
	{   
        $this->Tanggal 					= $Tanggal;  
        $this->NoBukti 					= $NoBukti;  
        $this->NoJurnal 				= $NoJurnal;  
        $this->Uraian 					= $Uraian;   
        $this->Group 					= '0'.$Group;   
    }
	
	function SimpanSiaJurnal()
	{
		$SiaJurnal 						= new Siajurnal;
		
		$SiaJurnal->Tanggal				= $this->Tanggal;
		$SiaJurnal->NoJurnal			= $this->NoJurnal;
		$SiaJurnal->NoBukti				= $this->NoBukti;
		$SiaJurnal->Uraian				= $this->Uraian;
		$SiaJurnal->save();
	}
	
	function SimpanSiaDetailJurnal($KodeAkun,$Nominal,$Posisi)
	{
		$this->KodeAkun 				= $KodeAkun;  
        $this->Nominal 					= $Nominal; 
		
		$SiaDetaiJurnal 				= new Siadetailjurnal;
		
		$SiaDetaiJurnal->KodeAkun		= $this->KodeAkun;
		$SiaDetaiJurnal->NoJurnal		= $this->NoJurnal;
		$SiaDetaiJurnal->lokasi 		= $this->Group;
		$SiaDetaiJurnal->tgl			= $this->Tanggal;
		$SiaDetaiJurnal->jns			= '-';
		$SiaDetaiJurnal->bln			= date('m');
		
		if ($Posisi=="Debit"){
			$SiaDetaiJurnal->Debet		= $this->Nominal;
		}else if($Posisi=="Kredit"){
			$SiaDetaiJurnal->Kredit		= $this->Nominal;
		}
		
		$SiaDetaiJurnal->save();
	}
}
?>