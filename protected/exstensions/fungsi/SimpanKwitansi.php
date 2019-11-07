<?
class SimpanKwitansi
{
	var $nonota;
	var $petugas;
	var $tanggal;
	var $nis;
	var $total;
	var $jns;
	var $bln;
	var $jml;
	var $jenis;
	var $nama;
	var $kdkls;
	var $th_ajaran;
	var $Denda;
	var $Total_Bayar;
	var $User;
	
	function __construct($nonota,$petugas,$tanggal,$nis,$total,$jns,$bln,$jml,$jenis,$nama,$th_ajaran)
	{   
        $this->nonota = $nonota;  
        $this->petugas = $petugas;  
        $this->tanggal = $tanggal;  
        $this->nis = $nis;   
        $this->total = $total;   
        $this->jns = $jns;   
        $this->bln = $bln;   
        $this->jml = $jml;   
        $this->jenis = $jenis;   
        $this->nama = $nama;   
		$this->kdkls = $kdkls;   
        $this->th_ajaran = $th_ajaran;   
    }
	
	Function Simpan()
	{
		$SimpanKwitansi = new Kwitansi;
		$SimpanKwitansi->nonota=$this->nonota;
		$SimpanKwitansi->petugas=$this->petugas;
		$SimpanKwitansi->tanggal=$this->tanggal;
		$SimpanKwitansi->nis=$this->nis;
		$SimpanKwitansi->total=$this->total;
		$SimpanKwitansi->jns=$this->jns;
		$SimpanKwitansi->bln=$this->bln;
		$SimpanKwitansi->jml=$this->jml;
		$SimpanKwitansi->jenis=$this->jenis;
		$SimpanKwitansi->nama=$this->nama;
		$SimpanKwitansi->kdkls=$this->kdkls;
		$SimpanKwitansi->th_ajaran=$this->th_ajaran;
		$SimpanKwitansi->save();
	}	
	Function SimpanDenda($Denda)
	{
		$this->Denda=$Denda;
		$SimpanKwitansi = new Kwitansi;
		$SimpanKwitansi->nonota=$this->nonota;
		$SimpanKwitansi->petugas=$this->petugas;
		$SimpanKwitansi->tanggal=$this->tanggal;
		$SimpanKwitansi->nis=$this->nis;
		$SimpanKwitansi->total=$this->total;;
		$SimpanKwitansi->jns=$this->jns;
		$SimpanKwitansi->bln=$this->bln;
		$SimpanKwitansi->jml=$this->Denda;
		$SimpanKwitansi->jenis='denda keterlambatan';
		$SimpanKwitansi->nama=$this->nama;
		$SimpanKwitansi->kdkls=$this->kdkls;
		$SimpanKwitansi->th_ajaran=$this->th_ajaran;
		$SimpanKwitansi->save();
	}	
}
?>