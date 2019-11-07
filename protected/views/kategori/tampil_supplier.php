<table width="100%" class="table table-bordered table-hover table-condensed">
	<thead>
		<tr>
			<th width="5%">#</th>
			<th width="8%">Kode </th>
			<th width="25%">Nama Supplier</th>
			<th>Alamat</th>
			<th width="15%">Telp.</th>
			<th width="13%"></th>
		</tr>
	</thead>
	<tbody>
		<? $no 	= 1;?>
		<? foreach($data as $data){?>
		<tr>
			<td style="text-align:right;"><? echo $no;?>.</td>
			<td style="text-align:center;"><? echo $data->no_id;?>
			<td><? echo $data->perusahaan;?>
			<td><? echo $data->alamat;?>
			<td><? echo $data->telp;?>
			<input type="hidden" class="form-control" id="nama_supplier_hapus_<? echo $data->no_id;?>" value="<? echo $data->perusahaan;?>"/>
			</td>
			<td><div class="btn-group">
				<a onclick="edit_supplier(<? echo $data->no_id;?>);" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-edit"><i class="fa fa-edit"></i></a>
				<span id="loading_delete_<?=$data->no_id; ?>"></span><a onclick="delete_supplier(<? echo $data->no_id;?>);" class="btn btn-primary btn-sm"><i class="fa fa-trash"></i> </a></div>
			</td>
		</tr>
		<?$no++;?>
		<?}?>
	</tbody>
</table>
<? echo $this->CreatePaging($page,$count,$limit,'list_supplier',false);?>