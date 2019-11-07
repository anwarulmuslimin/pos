<div class="box">
	<div class="box-header">
		<h3 class="box-title">Daftar Spam Item <? echo $nama_kategori; ?></h3>
	</div>
	
	<div class="box-body">
		<table class="table table-bordered table-hover table-condensed" >
				<tr>
					<th rowspan="2">#</th>
					<th rowspan="2">Item</th>
					<th colspan="2">Jumlah</th>
					<th rowspan="2">Kategori</th>
					<th rowspan="2">Harga Beli</th>
					<th rowspan="2">Harga Jual</th>
					<th rowspan="2"></th>
				</tr>
				<tr>
                    <th>Terjual</th>
                    <th>Stok</th>
				</tr>
				<? $_offset = $offset +1; ?>
				<? foreach($data as $item){

                    $cr_terjual             = new CDbCriteria;
                    $cr_terjual->select     = "SUM(pos_transaksi_detail_jumlah) AS pos_transaksi_detail_jumlah";
                    $cr_terjual->condition  = "pos_transaksi_detail_item_id='".$item->pos_item_id."' and pos_transaksi_detail_sekolah_id='".$this->GetSekolahId()."'";
                    $ItemTerjual            = PosTransaksiDetail::model()->find($cr_terjual);
                    
                    if($ItemTerjual->pos_transaksi_detail_jumlah > 0){
                        $jumlah_terjual         = $ItemTerjual->pos_transaksi_detail_jumlah;
                    }else{
                        $jumlah_terjual         = 0;
                    }?>
				<tr>
					<td><? echo ++$urut; ?></td>
					<td><? echo $item->pos_item_nama; ?>
						<input type="hidden" id="nama_item_<? echo $item->pos_item_id; ?>" value="<? echo $item->pos_item_nama; ?>">
					</td>
					<td align='center'><? echo $jumlah_terjual; ?></td>
					<td align='center'><? echo $item->pos_item_stok; ?></td>
					<td><? echo $this->GetNamaKategori($item->pos_item_kategori_id); ?></td>
					<td align="right"><? echo $this->Uang($item->pos_item_harga_beli); ?></td>
					<td align="right"><? echo $this->Uang($item->pos_item_harga_jual); ?></td>
					<td><div class="btn-group">	
						<input type="hidden" value="<? echo $item->pos_item_id; ?>" name="id_item_<? echo $urut; ?>"  id="id_item_<? echo $urut; ?>" >
						<a onclick="delete_item(<? echo $urut; ?>);" class="btn btn-bni">
							<i class="fa fa-trash" id="loading_delete_<? echo $item->pos_item_id; ?>"></i> </a></div>
					</td>
				</tr>
				<?	$total_item 		= $total_item + $item->pos_item_stok;
					$total_harga_beli 	= $total_harga_beli + $item->pos_item_harga_beli;
					$total_harga_jual 	= $total_harga_jual + $item->pos_item_harga_jual;
				?>
				<? $_offset++; ?>
				<?}?>
				<tr>
					<th colspan="2"><b>Total</b></th>
					<th style="text-align:center;"><b><? echo $total_item; ?></b></th>
					<th></th>
					<th style="text-align:right;"><? echo $this->Uang($total_harga_beli); ?></th>
					<th style="text-align:right;"><? echo $this->Uang($total_harga_jual); ?></th>
					<th></th>
				</tr>
		</table>
		<?=$this->CreatePaging($page,$count,$limit,'list_item',false);?>
	</div>
</div>