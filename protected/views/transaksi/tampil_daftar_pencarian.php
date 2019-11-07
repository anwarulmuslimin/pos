<table class="table table-condensed table-hover table-striped" width="100%">
	<tr>
		<th>Kode Barcode</th>
		<th>Nama</th>
		<th>Harga</th>
		<th>Stok</th>
		<th></th>
	</tr>
	<? foreach($data as $data){?>
	<tr>
		<td><? echo $data->kode;?><input type="hidden" id="id_cari_<? echo $data->kode; ?>" value="<? echo $data->kode; ?>"></td>
		<td><? echo $data->nama_barang;?></td>
		<td><? echo $this->Uang($data->h_jual);?></td>
		<td><? echo $data->stock_toko;?>
			<? $kode 	= $data->kode*1?>
			<input type="hidden" id="kode_barang_<? echo $kode?>" name="kode_barang_<? echo $kode?>" value="<? echo $data->kode?>">
		</td>
		<td><a onclick="pilih_item(<? echo $data->kode;?>);" class="btn btn-bni btn-flat" data-dismiss="modal" ><i class="fa fa-check"></i> </a></td>
	</tr>
	<?}?>
</table>