<? if($mode=='edit'){?>
	<table class="table table-condensed table-hover" width="100%">
		<tr>
			<td>Nama </td><td> &nbsp; &nbsp; <input type="text" class="form-control" value="<? echo $data->pos_profil_nama;?>" name="nama" id="nama"></td>
		</tr>
		<tr>
			<td>Alamat </td><td> &nbsp; &nbsp; <input type="text" class="form-control" value="<? echo $data->pos_profil_alamat;?>" name="alamat" id="alamat"></td>
		</tr>
		<tr>
			<td>Telp. </td><td> &nbsp; &nbsp; <input type="text" class="form-control" value="<? echo $data->pos_profil_telp;?>" name="telp" id="telp"></td>
		</tr>
	</table>
	<input type="hidden" class="form-control" value="<? echo $data->pos_profil_sekolah_id;?>" name="id_sekolah" id="id_sekolah">
<?}else{?>
<ul class="list-group list-group-unbordered">
	<li class="list-group-item">
		<b><? echo $data->pos_profil_nama;?></b>
	</li>
	<li class="list-group-item">
		<b><? echo $data->pos_profil_alamat;?></b>
	</li>
	<li class="list-group-item">
		<b><? echo $data->pos_profil_telp;?></b> <a class="pull-right" ></a>
	</li>
</ul>
<?}?>