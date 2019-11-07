<? foreach($looping_pembelian as $looping_pembelian){?>
		<p><b><? echo $this->GetNamaItem($looping_pembelian->pos_transaksi_temp_item_id); ?></b> &nbsp;&nbsp;
		Rp <? echo $this->Uang($looping_pembelian->pos_transaksi_temp_nominal); ?></p>
<?}?>

<input type="hidden" name="tampil_bayar" id="tampil_bayar" class="form-control" value="1"/>
<a onclick="remove_bayar(1);" class="btn btn-bni btn-flat"> Batal Belanja</a>