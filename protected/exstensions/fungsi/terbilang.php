<?php
//class Terbilang{
	function Terbilangx($x)
	{
	  $abil = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
	  if ($x < 12)
		return " " . $abil[$x];
	  elseif ($x < 20)
		return Terbilangx($x - 10) . " belas";
	  elseif ($x < 100)
		return Terbilangx($x / 10) . " puluh" . Terbilangx($x % 10);
	  elseif ($x < 200)
		return " seratus" . Terbilangx($x - 100);
	  elseif ($x < 1000)
		return Terbilangx($x / 100) . " ratus" . Terbilangx($x % 100);
	  elseif ($x < 2000)
		return " seribu" . Terbilangx($x - 1000);
	  elseif ($x < 1000000)
		return Terbilangx($x / 1000) . " ribu" . Terbilangx($x % 1000);
	  elseif ($x < 1000000000)
		return Terbilangx($x / 1000000) . " juta" . Terbilangx($x % 1000000);
	}
//}
?>