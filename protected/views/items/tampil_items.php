<?
if($mode=='excel'){
	$file	= "Data_Item.xls";
	header("Content-type: application/vnd.ms-excel");
	header("Content-Disposition: attachment; filename=$file");
	
	$element = ' border=1 cellspacing=0 cellpadding=0 width="100%"';
}else{
	$element = ' class="table table-condensed table-bordered table-hover" width="100%"';
}

$html.='
<div class="box">
	<div class="box-header">
		<h3 class="box-title">Daftar Item '.$kode_kategori.'</h3>
	</div>
	
	<div class="box-body">
		<table id="item" '.$element.' >
			<thead>
				<tr>
					<th  width="2%" style="text-align:center;">#</th>
					<th  width="10%" style="text-align:center;">Kode Barang</th>
					<th  style="text-align:center;">Nama Barang</th>
					<th  width="5%" style="text-align:center;">Jumlah</th>
					<th  style="text-align:center;">Jenis</th>
					<th  width="10%" style="text-align:center;">Harga Beli</th>
					<th  width="10%" style="text-align:center;">Harga Jual</th>';
					if($mode!='excel'){
$html.='
					<th  width="15%"></th>';
					}
$html.='		</tr>
			</thead>
			<tbody>';
					 $_offset = $offset +1; 
				 	foreach($data as $item){
						if($mode=='excel'){
							$rp_beli 	= $item->h_beli;
							$rp_jual 	= $item->h_jual;
						}else{
							$rp_beli 	= $this->Uang($item->h_beli);
							$rp_jual 	= $this->Uang($item->h_jual);
						}
					$cr_stok 				= new CDbCriteria;
					$cr_stok->condition 	= "lokasi='".$toko."' and kode='".$item->kode."'";
					$modstok 				= StokToko::model()->find($cr_stok);
$html.='						 
				<tr>
					<td  style="text-align:right;">'.++$urut.'</td>
					<td  style="text-align:center;"><code>'.$item->kode.'</code></td>
					<td>'.$item->nama_barang.'
						<input type="hidden" id="nama_item_'.$item->kode.'" value="'.$item->nama_barang.'">
					</td>
					<td align="center">'.$item->stock_toko.'</td>
					<td>'.$item->jenis.'</td>
					<td align="right">'.$rp_beli.'</td>
					<td align="right">'.$rp_jual.'</td>';
				if($mode!='excel'){
$html.='			<td><div class="btn-group">	
						<a onclick="edit_item('.$urut.');" class="btn btn-bni" data-toggle="modal" data-target="#modal_edit">
							<i class="fa fa-edit"></i> </a>
							<input type="hidden" value="'.$item->kode.'" name="id_item_'.$urut.'"  id="id_item_'.$urut.'" >
						<a onclick="delete_item('.$urut.');" class="btn btn-bni">
							<i class="fa fa-trash" id="loading_delete_'.$item->kode.'"></i> </a></div>
						<a target="_blank" href="'.Yii::app()->CreateUrl('barcode/tampil_barcode',array('kode'=>$item->kode,'toko'=>$toko)).'" class="btn btn-bni" title="klik cetak barcode">
							<i class="fa fa-barcode" id="loading_barcode_'.$item->kode.'"></i> </a></div>
					</td>';
				}
$html.='
				</tr>';
					$total_item 		= $total_item + $item->stock_toko;
					$total_harga_beli 	= $total_harga_beli + $item->h_beli;
					$total_harga_jual 	= $total_harga_jual + $item->h_jual;
				
				 $_offset++; 
				}

				if($mode=='excel'){
					$tot_beli 	= $total_harga_beli;
					$tot_jual 	= $total_harga_jual;
				}else{
					$tot_beli 	= $this->Uang($total_harga_beli);
					$tot_jual 	= $this->Uang($total_harga_jual);
				}
$html.='	
			</tbody>
			<tfoot>
				<tr>
					<th colspan="3"><b>Total</b></th>
					<th style="text-align:center;"><b>'.$total_item.'</b></th>
					<th></th>
					<th style="text-align:right;">'.$tot_beli.'</th>
					<th style="text-align:right;">'.$tot_jual.'</th>
					';
					if($mode!='excel'){
$html.='
					<th></th>';
					}
$html.='
				</tr>
			</tfoot>
		</table>
		'.$this->CreatePaging($page,$count,$limit,'list_item',false).'
	</div>
</div>';
echo $html;