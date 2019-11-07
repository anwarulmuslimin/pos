<? 
Class SimpanTransaksiBayar
{
	var $id;
	var $nis;
	var $jns;
	var $nota;
	var $bln;
	var $bayar;
	var $thkonsep;
	var $piutang;
	var $potongan;
	var $Denda;
	var $id_user;
	var $lokasi;
	
	
	function __construct($id,$nis,$jns,$nota,$bln,$bayar,$thkonsep,$piutang,$potongan,$Denda,$id_user,$lokasi)
	{   
        $this->id 				= $id;  
        $this->nis 				= $nis;  
        $this->jns 				= $jns;  
        $this->nota 			= $nota;   
        $this->bln 				= $bln;   
        $this->bayar 			= $bayar;   
        $this->thkonsep 		= $thkonsep;   
        $this->piutang 			= $piutang;   
        $this->potongan 		= $potongan;   
        $this->Denda 			= $Denda;   
        $this->id_user 			= $id_user;   
        $this->lokasi 			= $lokasi;   
    }
	
	function Simpan()
	{
			$SimpanTransaksi 				= new transaksi_bayar;

			$SimpanTransaksi->idkonsep		= $this->id;
			$SimpanTransaksi->nis			= $this->nis;
			$SimpanTransaksi->jns			= $this->jns;
			$SimpanTransaksi->nonota		= $this->nota;
			$SimpanTransaksi->bln			= $this->bln;
			$SimpanTransaksi->jml			= $this->bayar;
			$SimpanTransaksi->th_ajaran		= $this->thkonsep;
			$SimpanTransaksi->piutang		= $this->piutang;
			$SimpanTransaksi->potongan		= $this->potongan;
			$SimpanTransaksi->denda			= $this->Denda;
			$SimpanTransaksi->id_user		= $this->id_user;
			$SimpanTransaksi->lokasi		= $this->lokasi;
			$SimpanTransaksi->save();
		
	}

}