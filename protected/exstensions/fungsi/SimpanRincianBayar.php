<?php
class SimpanRincianBayar
{
	var $TanggalBayar;
	var $NoBuktiBayar;
	var $TotalBayar;
	var $PetugasBayar;
	var $LokasiToko;
	var $DiskonBayar;
	var $KembaliBayar;
	var $KodeBarang;
	var $NominalBayar;
	var $JumlahBarang;
	var $GroupBarang;
	var $KodeSuplier;
	
	
	function __construct($TanggalBayar,$NoBuktiBayar,$PetugasBayar,$LokasiToko,$DiskonBayar)
	{   
        $this->TanggalBayar = $TanggalBayar;  
        $this->NoBuktiBayar = $NoBuktiBayar;  
		$this->PetugasBayar = $PetugasBayar; 
		$this->LokasiToko 	= $LokasiToko; 
		$this->DiskonBayar 	= $DiskonBayar; 
    }
	
	function SimpanByr($KembaliBayar,$TotalBayar)
	{
		 
        $this->KembaliBayar = $KembaliBayar;
		$this->TotalBayar 	= $TotalBayar;  
		
		$_Byr = new TransaksiKoperasi;
		
		$_Byr->id 	 		= '0';
		$_Byr->NoNota 		= $this->NoBuktiBayar;
		$_Byr->kasir 		= $this->PetugasBayar;
		$_Byr->TglNota 		= $this->TanggalBayar;
		$_Byr->diskon		= $this->DiskonBayar;
		$_Byr->bayar 		= $this->TotalBayar;
		$_Byr->kembalian 	= $this->KembaliBayar;
		$_Byr->lokasi 		= $this->LokasiToko;
		
		if($_Byr->save()){
			return 1;
		}else{
			require 0;
		}
		
	}	
	
	function SimpanDbyr($KodeBarang,$NominalBayar,$JumlahBarang,$GroupBarang,$KodeSuplier,$HargaBeli)
	{
		$this->KodeBarang 			= $KodeBarang;  
		$this->NominalBayar			= $NominalBayar;   
		$this->JumlahBarang			= $JumlahBarang;  
		$this->GroupBarang 			= $GroupBarang;  
		$this->KodeSuplier 			= $KodeSuplier;  
		$this->HargaBeli 			= $HargaBeli;
		
		$total_bayar_barang 		= $NominalBayar*$JumlahBarang;
		
		$_Dbyr 						= new Item;
		
		$_Dbyr->iNonota				= $this->NoBuktiBayar;
		$_Dbyr->iKodeBr				= $this->KodeBarang;
		$_Dbyr->iJumlah				= $this->JumlahBarang;
		$_Dbyr->iharga  			= $this->NominalBayar;
		$_Dbyr->iTotal  			= $total_bayar_barang;
		$_Dbyr->igolongan 			= $this->GroupBarang;
		$_Dbyr->isuplier			= $this->KodeSuplier;
		$_Dbyr->idiskon 			= $this->DiskonBayar;
		$_Dbyr->tgl 				= $this->TanggalBayar;
		$_Dbyr->user 				= $this->PetugasBayar;
		$_Dbyr->lokasi 				= $this->LokasiToko;
		$_Dbyr->ibeli 				= $this->HargaBeli;

		$_Dbyr->save();
	}
}
?>