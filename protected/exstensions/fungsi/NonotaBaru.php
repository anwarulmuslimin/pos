<?
class Nota
{
	function NewNota()
	{
			session_start();
			setlocale (LC_TIME, 'id_ID');
			$date = strftime( "%A, %d %B %Y %H:%M", time());
			$today = date("dmY");

			$faktur=array('a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z','0','1','2','3','4','5','6','7','8','9');
			shuffle($faktur);
			reset($faktur);

			$no=0;
			foreach($faktur as $line)
			{
				$kode_faktur.=strtoupper($line);
				$no++;
				if (($no >= 10)) break;
			}	
			
			return $today.$kode_faktur;
	}	
}	
?>