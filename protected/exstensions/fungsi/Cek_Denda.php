<?
Class Cek_Denda
{
	var $Tgl_Tagihan;
	var $Jatuh_tempo;
		
	Function Cek($Jatuh_tempo)
	{
		$this->Tgl_Bayar = date('Y-m-d');
		$this->Jatuh_tempo = $Jatuh_tempo;
		
		$data1=explode("-",$this->Jatuh_tempo);
		$tanggal1 = $data1[2];
		$bulan1 = $data1[1];
		$tahun1 = $data1[0];
		
		$data2=explode("-",$this->Tgl_Bayar);
		$tanggal2 = $data2[2];
		$bulan2 = $data2[1];
		$tahun2 = $data2[0];
		
		$dari = GregorianToJD($bulan1,$tanggal1,$tahun1);
		$Hingga = GregorianToJD($bulan2,$tanggal2,$tahun2);

		$this->Jatuh_tempo=$Hingga-$dari;
		$Jumlah_denda = $this->Jatuh_tempo*1000;
		if ($Jumlah_denda<0){
			$Jumlah_denda = 0;
		}		
		return $Jumlah_denda;
	}
}
?>