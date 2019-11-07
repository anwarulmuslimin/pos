	<br/><br/><div class="box box-default color-palette-box" style="min-height:850px;width:1110px" >
        <div class="box-header with-border">
          <h3 class="box-title"><i class="fa fa-exchange"></i><span id="loading"></span> Ganti Password</h3>
		  <input type="hidden" class="form-control" id="sekolah_id" name="sekolah_id" value="<? echo $sekolah_id;?>">
		  <a href="#" data-toggle="modal" onclick="loadManualBook(7)" data-target="#myModalBantuan" class="pull-right" title="Klik Bantuan"><i class="fa fa-question-circle fa-2x"></i></a>
        </div>
        <div class="box-body" >
			<div class="row" >
				<div class="col-md-6">
					<div class="box">
						<form action="<? echo Yii::app()->createUrl('home/updatepassword');?>" method="POST">
							<table  class="table table-condensed" width="100%">
								<tr>
									<th style="width: 10px"></th>
									<th>Username</th>
									<th><input type="text" class="form-control" id="edit_username" name="edit_username" value="<? echo $modganti_password->pos_user_username;?>"></th>
								</tr>
								<tr>
									<th style="width: 10px"></th>
									<th>Password</th>
									<th><input type="password" class="form-control" id="edit_password"  name="edit_password" placeholder="Password"></th>
								</tr>
								<tr>
									<th style="width: 10px"></th>
									<th>Konfirmasi Password</th>
									<th><input type="password" class="form-control" id="konfirmasi_password" name="konfirmasi_password" placeholder="Konfirmasi Password"></th>
								</tr>
							</table>
							<input type="hidden" class="form-control" id="pos_user_id" name="pos_user_id" value="<? echo $modganti_password->pos_user_id;?>">
							<div class="btn-group">
								<a class="btn btn-bni"> batal</a>
								<button type="submit" class="btn btn-bni"> update</button>
							</div>
							<? if($status=="update password berhasil."){?>
							<br/><br/>
							<div class="alert alert-info alert-dismissible">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<? echo $status;?>
							 </div>
							<?}elseif($status=="update password gagal."){?>
							<br/><br/>
							<div class="alert alert-danger alert-dismissible">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<? echo $status;?>
							 </div>
							<?}?>
						</form>
					</div>
				</div>
			</div>
        </div>
      </div>

