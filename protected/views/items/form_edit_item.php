<label>Barang</label>
		<input type="hidden" class="form-control" id="update_barcode" name="update_barcode" readonly value="<? echo $item->kode; ?>"  class="col-md-3">
		<input class="form-control" id="tampilan" name="tampilan" readonly value="<? echo $item->kode; ?> - <? echo $item->nama_barang; ?> "  class="col-md-3">

<label>Katagori</label>
		<select class="form-control" id="update_kategori" name="update_kategori" class="col-md-3">
			<option>Pilih Katagori</option>
			<? $modkatagori 	= Katagori::model()->findAll();?>
			<? foreach($modkatagori as $modkatagori){?>
				<option <? if($kategori==$modkatagori->nama_katagori){ echo'selected';}?> value="<? echo $modkatagori->nama_katagori; ?>"><? echo $modkatagori->nama_katagori; ?></option>
			<?}?>
		</select>	
<label>Jenis</label>
<select class="form-control" id="update_jenis" name="update_jenis" class="col-md-3">
	<option>Pilih Jenis</option>
	<? $modjenis 	= Jenis::model()->findAll();?>
	<? foreach($modjenis as $modjenis){?>
		<option <? if($jenis==$modjenis->nama_jenis){ echo'selected';}?> value="<? echo $modjenis->nama_jenis; ?>"><? echo $modjenis->nama_jenis; ?></option>
	<?}?>
</select>
<label>Nama Item</label>
	<input type="text" class="form-control" id="update_item" name="update_item"  value="<? echo $item->nama_barang; ?>"  class="col-md-3">
	<input type="hidden" class="form-control" id="update_lokasi" name="update_lokasi"  value="<? echo $lokasi; ?>"  class="col-md-3">
	<?
		$cr_stok 				= new CDbCriteria;
		$cr_stok->condition 	= "lokasi='".$lokasi."' and kode='".$item->kode."'";
		$modstok 				= StokToko::model()->find($cr_stok);
	?>
<label>Sisa Stok Toko</label>
	<input type="text" class="form-control" readonly id="update_jml_item" name="update_jml_item" onkeypress="return hanyaAngka(event)"  value="<? echo $modstok->stock_toko; ?>"  class="col-md-3">

<label>Harga Beli (@)</label>
<input type="text" class="form-control" id="update_harga_beli" name="update_harga_beli" onkeypress="return hanyaAngka(event)" value="<? echo $item->h_beli; ?>"  class="col-md-3">
<label>Harga Jual (@)</label>
<input type="text" class="form-control" id="update_harga_jual" name="update_harga_jual" onkeypress="return hanyaAngka(event)" value="<? echo $item->h_jual; ?>"  class="col-md-3">

<script>
	function hanyaAngka(evt) {
	  var charCode = (evt.which) ? evt.which : event.keyCode
	   if (charCode > 31 && (charCode < 48 || charCode > 57))

		return false;
	  return true;
	}
</script>