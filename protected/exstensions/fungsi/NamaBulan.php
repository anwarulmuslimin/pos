<?
class NamaBulan
{
	var $bulan;
	var $bln;
	
	function GetNamaBulan($bulan)
	{
		$this->bulan = $bulan;
		
		switch($this->bulan){      
	        case 1 : {
	                    $this->bln='Januari';
	                }break;
	        case 2 : {
	                    $this->bln='Februari';
	                }break;
	        case 3 : {
	                    $this->bln='Maret';
	                }break;
	        case 4 : {
	                    $this->bln='April';
	                }break;
	        case 5 : {
	                    $this->bln='Mei';
	                }break;
	        case 6 : {
	                    $this->bln="Juni";
	                }break;
	        case 7 : {
	                    $this->bln='Juli';
	                }break;
	        case 8 : {
	                    $this->bln='Agustus';
	                }break;
	        case 9 : {
	                    $this->bln='September';
	                }break;
	        case 10 : {
	                    $this->bln='Oktober';
	                }break;    
	        case 11 : {
	                    $this->bln='November';
	                }break;
	        case 12 : {
	                    $this->bln='Desember';
	                }break;
	    }
		
		return $this->bln;
	}
}

?>