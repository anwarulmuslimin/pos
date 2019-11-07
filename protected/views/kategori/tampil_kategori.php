<table width="100%" class="table table-bordered table-hover table-condensed">
	<thead>
		<tr>
			<th width="5%">#</th>
			<th>Nama Kategori</th>
			<th width="13%"></th>
		</tr>
	</thead>
	<tbody>
		<? $no 	= 1;?>
		<? foreach($modkategori as $data){?>
		<tr>
			<td style="text-align:right;"><? echo $no;?>.</td>
			<td><? echo $data->nama_katagori;?>
			<input type="hidden" class="form-control" id="nama_kategori_hapus_<? echo $data->nama_katagori;?>" value="<? echo $data->nama_katagori;?>"/>
			</td>
			<td><div class="btn-group">
				<a onclick="edit_kategori(<? echo $data->nama_katagori;?>);" class="btn btn-bni" data-toggle="modal" data-target="#modal-edit"><i class="fa fa-edit"></i></a>
				<a  href="<? echo Yii::app()->createUrl('items/list',['kategori'=>$data->nama_katagori]);?>" class="btn btn-bni"><i class="fa fa-list"></i> </a>
				<a onclick="delete_kategori(<? echo $data->nama_katagori;?>);" class="btn btn-bni"><i class="fa fa-trash"></i> </a></div>
			</td>
		</tr>
		<?$no++;?>
		<?}?>
	</tbody>
</table>