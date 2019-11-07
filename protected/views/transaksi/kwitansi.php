<style>
	@media print{
		font {
			page-break-after:always;
			size:12px;
		}
		body{
			font-size:12px;
		}

	}
</style>
<?
		$cr_profil 					= new CDbCriteria;
		$cr_profil->condition 		= "lokasi='".$this->GetSekolahId()."'";
		$profil_Sekolah 			= Header::model()->find($cr_profil);

date_default_timezone_set("Asia/Jakarta");

echo '<font>
		<center style="color:black;text-align:center;font-size:14px;border-bottom:2px dotted black">
			<b>'.$profil_Sekolah->nb.'</b><br/>'.$profil_Sekolah->head1.'
		</center>';
		
echo '<table class="table table-condensed" width="100%">
		<tr>
			<td align="center" style="border-bottom: 2px dotted black;"><b>Nama</b></td>
			<td align="center" style="border-bottom: 2px dotted black;"><b>Qty</b></td>
			<td align="center" style="border-bottom: 2px dotted black;"><b>Harga</b></td>
			<td align="center" style="border-bottom: 2px dotted black;"><b>Diskon</b></td>
			<td align="center" style="border-bottom: 2px dotted black;"><b>Total</b></td>
		</tr>';
		$T_bayar = 0;
		foreach ($kwitansi_pos as $value) {
			$nama_item 		= $this->GetNamaItem($value->iKodeBr);
			$Qty_item 		= $value->iJumlah;
			$Harga_item 	= $value->iharga;
			$Diskon 	 	= $value->idiskon;
			$Total_Harga 	= $value->iTotal;
			
			echo '	<tr>
						<td align="left">'.$nama_item.'</td>
						<td align="center">'.$Qty_item.'</td>
						<td align="right">'.$this->Uang($Harga_item).'</td>
						<td align="right">'.$this->Uang($Diskon).'</td>
						<td align="right">'.$this->Uang($Total_Harga-$Diskon).'</td>
					</tr>';
			$T_Diskon 	= $T_Diskon + $Diskon;
			$T_bayar 	= $T_bayar + $Total_Harga;
		}
		$jumlah_belanja = $T_bayar - $T_Diskon;
		$kembali = $UangCash - $jumlah_belanja;
		echo '
			<tr>
				<td colspan="5" style="border-top: 2px dotted black;"><b>&nbsp;</b></td>
			</tr>
			<tr>
				<td colspan="4"><b>Total Belanja</b></td>
				<td align="right"><b>'.$this->Uang($T_bayar - $T_Diskon).'</b></td>
			</tr>
			<tr>
				<td colspan="3">Dibayar</td>
				<td></td>
				<td align="right">'.$this->Uang($UangCash).'</td>
			</tr>
			<tr>
				<td colspan="3">Kembalian</td>
				<td></td>
				<td align="right">'.$this->Uang($kembali).'</td>
			</tr>
			<tr>
				<td colspan="5" style="border-top: 2px dotted black;"><b>&nbsp;</b></td>
			</tr>
			';
		
		

		echo'	</table>';
	echo '<p>
			'.$profil_Sekolah->nb2.'<br>
		</p>
	</font>';
		?>