<table class="table table-hover table-condensed" width="100%">
		<tr>
			<th></th>
			<th>Kode</th>
			<th>Nama Item</th>
			<th>Harga</th>
			<th>Jumlah</th>
			<th>Diskon</th>
			<th>Total</th>
		</tr>
		<? foreach($transaksi_temp as $transaksi_temp){
			$cr_item 	 				= new CDbCriteria;
			$cr_item->condition 		= "kode='".$transaksi_temp->kd_barang."'";
			$Item 	 					= Barang::model()->find($cr_item);
			$nominal_diskon 			= $this->HargaDiskon($transaksi_temp->kd_barang,$transaksi_temp->idtoko);
		?>
		<tr>
			<td><a onclick="hapus_temp(<? echo $transaksi_temp->id;?>);" style="cursor:pointer"> <i class="fa fa-remove"></i></a></td>
			<td><? echo $Item->kode;?></td>
			<td><? echo $Item->nama_barang;?> - <? echo $Item->jenis;?></td>
			<td><? echo $this->Uang($Item->h_jual);?></td>
			<td>
			<input type="hidden" name="temp_jml_beli<? echo $transaksi_temp->id;?>" id="temp_jml_beli<? echo $transaksi_temp->id;?>" value="<? echo $transaksi_temp->jumlah;?>">
			<input type="hidden" name="nama_brg_<? echo $transaksi_temp->id;?>" id="nama_brg_<? echo $transaksi_temp->id;?>" value="<? echo $Item->nama_barang;?>">
			<input type="hidden" name="kode_brg_<? echo $transaksi_temp->id;?>" id="kode_brg_<? echo $transaksi_temp->id;?>" value="<? echo $Item->kode;?>">
				<span id="form_edit_<? echo $transaksi_temp->id;?>"><? echo $transaksi_temp->jumlah;?>
					<a onclick="edit_jml(<? echo $transaksi_temp->id;?>);" style="cursor:pointer;" title="edit jumlah pembelian">
						<i class="fa fa-pencil"></i>
					</a>
				</span>		
			</td>
			<td><? echo $this->Uang($nominal_diskon*$transaksi_temp->jumlah);?></td>
			<td><? echo $this->Uang(($Item->h_jual*$transaksi_temp->jumlah)-($nominal_diskon*$transaksi_temp->jumlah));?></td>
		</tr>
		<?}?>
</table>
