
<table class="table no-margin">
	<thead>
		<tr>
			<th>ID</th>
			<th>Item</th>
			<th>Jumlah Terjual</th>
			<th>Sisa Stok</th>
		</tr>
	</thead>
	<tbody>
		<? foreach($LimitItem as $data){
				$cr_jual 			= new CDbCriteria;
				$cr_jual->select	= "sum(pos_transaksi_detail_jumlah) as pos_transaksi_detail_jumlah";
				$cr_jual->condition	= "	pos_transaksi_detail_item_id='".$data->pos_item_id."' 
										and pos_transaksi_detail_sekolah_id='".$sekolah_id."'";
				$ItemTerjual		= PosTransaksiDetail::model()->find($cr_jual);
				if($ItemTerjual->pos_transaksi_detail_jumlah > 0){
					$totalterjual		= $ItemTerjual->pos_transaksi_detail_jumlah;
				}else{
					$totalterjual		= 0;
				}
		
		?>
		<tr>
			<td><code><? echo $data->pos_item_id; ?></code></td>
			<td><? echo $data->pos_item_nama; ?></td>
			<td><? echo $totalterjual; ?></td>
			<td><div class="sparkbar" data-color="#00a65a" data-height="20"><? echo $data->pos_item_stok; ?></div></td>
		</tr>
		<?}?>
	</tbody>
</table>