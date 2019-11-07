<div class="box-header">
  <h3 class="box-title">Edit User</h3>
</div>
<table  class="table table-condensed" width="100%">
	<tr>
		<th style="width: 10px"></th>
		<th>Username</th>
		<th><input type="text" class="form-control" id="edit_username" name="edit_username" value="<? echo $modedit_user->pos_user_username;?>"></th>
	</tr>
	<tr>
		<th style="width: 10px"></th>
		<th>Password</th>
		<th><input type="password" class="form-control" id="edit_password" placeholder="Password"></th>
	</tr>
	<tr>
		<th style="width: 10px"></th>
		<th>Konfirmasi Password</th>
		<th><input type="password" class="form-control" id="konfirmasi_password" placeholder="Konfirmasi Password"></th>
	</tr>
</table>
<input type="hidden" class="form-control" id="pos_user_id" name="pos_user_id" value="<? echo $modedit_user->pos_user_id;?>">
<div class="btn-group">
	<a onclick="batal();" class="btn btn-info"> batal</a>
	<a onclick="update_user(<? echo $modedit_user->pos_user_id;?>);" class="btn btn-success"> update</a>
</div>

