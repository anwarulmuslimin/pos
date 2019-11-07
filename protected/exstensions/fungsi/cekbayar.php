<?
class cekbayar
{
	var $status;
	function cek($nota,$nis)
	{

	$cr = new CDbCriteria;
	$cr->condition = "nis = '".$nis."' and nonota = '".$nota."'";
	$Bayar=transaksi_bayar::model()->find($cr);
	
		if ($Bayar->nis==$nis){
			$status=true;
		}else{	
			$status=false;
		}
		return $status;
	}
}
?>