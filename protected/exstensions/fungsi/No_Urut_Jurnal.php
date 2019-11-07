<?
class No_Urut_Jurnal
{
	var $Max_J;
	var $New_J;

	function GetNoJurnal_Baru()
	{
		$kriteria_max = new CDbCriteria;
		$kriteria_max->select="max(NoJurnal) as MaxNoJurnal";
		$MaxJurnal = Siajurnal::model()->find($kriteria_max);
		
		$This->Max_J=$MaxJurnal['MaxNoJurnal'];
		
		$This->New_J = $This->Max_J+1;
		return $This->New_J;
	}	
}
?>