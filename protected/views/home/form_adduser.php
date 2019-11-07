<div class="box-header">
              <h3 class="box-title"><i class="fa fa-user-plus"></i> Tambah User</h3>
            </div>
<table  class="table table-condensed" width="100%">
	<tr>
		<th style="width: 10px"></th>
		<th>Username</th>
		<th><input type="email" class="form-control" id="add_username" name="add_username"  placeholder="Username"></th>
	</tr>
	<tr>
		<th style="width: 10px"></th>
		<th>Password</th>
		<th><input type="password" class="form-control" id="add_password" name="add_password" placeholder="Password"></th>
	</tr>
	<tr>
		<th style="width: 10px"></th>
		<th>Konfirmasi Password</th>
		<th><input type="password" class="form-control" id="add_konfirmasi_password" name="add_konfirmasi_password" placeholder="Konfirmasi Password"></th>
	</tr>
</table>
<input type="hidden" class="form-control" id="sekolah_id" name="sekolah_id" value="<? echo $sekolah_id;?>">
<div class="btn-group">
	<a onclick="batal();" class="btn btn-info"> batal</a>
<a onclick="simpan_user();" class="btn btn-success"><span id="loading_simpan"></span> simpan user</a>
</div>

