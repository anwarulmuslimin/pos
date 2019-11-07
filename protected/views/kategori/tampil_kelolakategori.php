<div class="box">
	<div class="box-header">
		<h3 class="box-title">Daftar Spam Item <? echo $nama_kategori; ?></h3>
	</div>
	<div class="box-body">
        <table class="table table-bordered table-hover table-condensed">
            <thead>
                <tr>
                    <th width="5%">#</th>
                    <th>Nama Kategori</th>
                    <th width="15%"></th>
                </tr>
            </thead>
            <tbody>
                <? $no 	= 1;?>
                <? foreach($modkategori as $data){?>
                <tr>
                    <td><? echo $no;?></td>
                    <td><? echo $data->pos_kategori_nama;?>
                    <input type="hidden" class="form-control" id="nama_kategori_hapus_<? echo $data->pos_kategori_id;?>" value="<? echo $data->pos_kategori_nama;?>"/>
                    </td>
                    <td><div class="btn-group">
                        <a onclick="delete_kelolakategori(<? echo $data->pos_kategori_id;?>);" class="btn btn-bni"><i class="fa fa-trash"></i> </a></div>
                    </td>
                </tr>
                <?$no++;?>
                <?}?>
            </tbody>
        </table>
    </div>
</div>