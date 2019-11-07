<table width="100%" class="table table-bordered table-hover table-condensed">
	<thead>
		<tr>
			<th width="5%">#</th>
			<th>Nama Jenis</th>
			<th width="13%"></th>
		</tr>
	</thead>
	<tbody>
		<? $no 	= 1;?>
		<? foreach($modjenis as $data){?>
		<tr>
			<td style="text-align:right;"><? echo $no;?>.</td>
			<td><? echo $data->nama_jenis;?>
			<input type="hidden" class="form-control" id="nama_kategori_hapus_<? echo $data->nama_jenis;?>" value="<? echo $data->nama_jenis;?>"/>
			</td>
			<td>
			</td>
		</tr>
		<?$no++;?>
		<?}?>
	</tbody>
</table>