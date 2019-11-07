<?
class GetTokojenis
{
		var $Kode_toko;
		var $Kode_KAS;
		var $Kode_BB;
		var $Kode_PENDAPATAN;

	function Kode_GetToko($Kode_toko)
	{
		$this->Kode_toko = $Kode_toko;
		
		$kriteria = new CDbCriteria;
		$kriteria->condition=" kode='0".$this->Kode_toko."'";
		
		$NamaJenis = SiaakunStatis::model()->find($kriteria);

		$this->Kode_KAS = $NamaJenis->kas;
		$this->Kode_BB = $NamaJenis->bb;
		$this->Kode_PENDAPATAN = $NamaJenis->P;
	}
	
	function GetKode_KAS()
	{
		return $this->Kode_KAS;
	}	

	function GetKode_BB()
	{
		return $this->Kode_BB;
	}	

	function GetKode_PENDAPATAN()
	{
		return $this->Kode_PENDAPATAN;
	}
}

?>