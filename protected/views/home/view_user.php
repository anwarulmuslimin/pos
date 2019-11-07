
<table class="table table-bordered">
	<tr>
		<th style="width: 10px">#</th>
		<th>Username</th>
		<th>Password</th>
		<th>Kategori User</th>
		<th style="width: 120px"></th>
	</tr>
	<? $no 	= 1;?>
	<? foreach($moduser as $data){?>
	<tr>
		<th style="width: 10px"><? echo $no;?></th>
		<th><? echo $data->user;?></th>
		<th> ****** </th>
		<th> <? echo $data->tipe_user;?> </th>
		<th><input type="hidden" class="form-control" id="pos_user_username_<? echo $data->id;?>" name="pos_user_username_<? echo $data->id;?>" value="<? echo $data->user;?>">
			<div class="btn-group">
			<a class="btn btn-bni" onclick="edit_user(<? echo $data->id;?>);">
				<i class="fa fa-pencil"></i><span id="loading_<? echo $data->id ?>"></span> </a>
			<a class="btn btn-danger" onclick="delete_user(<? echo $data->id;?>);">
			<i class="fa fa-trash"></i><span id="loading_delete<? echo $data->id ?>"></span> </a>
			</div>
		</th>
	</tr>
	<?$no++;?>
	<?}?>
</table>