<table class="table table-condensed" width="100%">
	<tr>
		<td>Nama Item</td>
		<td>Stok </td>
		<td>Harga </td>
		<td>Jumlah </td>
		<td></td>
	</tr>
	<?
		$cr_stok 									= new CDbCriteria;
		$cr_stok->condition							= "kode='".$data->kode."' and lokasi='".$this->GetSekolahId()."'";
		$modStoktoko 								= StokToko::model()->find($cr_stok);
	?>
	<tr>
		<td><input type="hidden" readonly class="form-control"  rel="tooltip" id="kd_item"  name="kd_item" value="<? echo $data->kode; ?>">
		<input type="text" readonly class="form-control"  rel="tooltip" id="nama_item"  style="width:300px;" name="nama_item" value="<? echo $data->nama_barang; ?>"></td>
		<td><input type="text" readonly class="form-control"  rel="tooltip" id="stok_item"  style="width:50px;" name="stok_item" value="<? echo $modStoktoko->stock_toko; ?>"></td>
		<td><input type="text" readonly class="form-control"  rel="tooltip" id="harga_jual"  style="width:100px;" name="harga_jual" value="<? echo $this->Uang($data->h_jual); ?>"></td>
		<td><input type="text" value="1" class="form-control" style="width:50px;" name="jml_item2" id="jml_item2" onkeypress="return MasukanKeranjang(event);"/></td>
		<td><a class="btn btn-bni btn-flat" onclick="belanja_temp();" id="btnKeranjang"><i class="fa fa-cart-arrow-down"></i> Belanja</a></td>
	</tr>
</table>