<br/><br/><div class="box box-default color-palette-box"  style="min-height:850px;width:1110px">
        <div class="box-header with-border">
          <h3 class="box-title"><i class="fa fa-user-plus"></i><span id="loading"></span> Daftar User</h3>
		  <input type="hidden" class="form-control" id="sekolah_id" name="sekolah_id" value="<? echo $sekolah_id;?>">
		  <a href="#" data-toggle="modal" onclick="loadManualBook(6)" data-target="#myModalBantuan" class="pull-right" title="Klik Bantuan"><i class="fa fa-question-circle fa-2x"></i></a>
        </div>
        <div class="box-body">
			<div class="row">
				<div class="col-md-6">
					<div class="box">
						<div class="box-body">
							<table class="table table-bordered" id="daftar_user">
								<tr>
									<th style="width: 10px">#</th>
									<th>Username</th>
									<th>Password</th>
									<th style="width: 20px"></th>
								</tr>
							</table><br/>
							<a class="btn btn-bni" onclick="list_user();"><i class="fa fa-refresh"></i> Refresh</a>
							<a class="btn btn-bni" onclick="add_user();"><i class="fa fa-user-plus"></i><span id="loading_add"></span> Tambah User</a>
						</div>
					</div>
				</div>
				<div class="col-md-6" style="display:none" id="form_action">
					<div class="box">
						<div class="box-body no-padding"  id="view_form_action"></div>
					</div>
				</div>
			</div>
        </div>
      </div>
	  <script type="text/javascript">  
		window.onload= function(){
			list_user();
		}
			 
			function add_user(){
				$("#loading_add").html('<img src="<? echo Yii::app()->baseUrl?>/images/loading.gif" width="20" heigt="20"/>');
				var sekolah_id 	= $("#sekolah_id").val();
					$.ajax({
							type: "POST",
							url: "<? echo Yii::app()->createUrl('home/add_user');?>",
							data: "sekolah_id="+sekolah_id,
							cache: false,
							success: function(html){
								$("#form_action").show();
								$("#view_form_action").html(html);
								$("#loading_add").html('');
							} 
						}
					);
			}	
			
			function simpan_user(){
				$("#loading_simpan").html('<img src="<? echo Yii::app()->baseUrl?>/images/loading.gif" width="20" heigt="20"/>');
				var sekolah_id 		= $("#sekolah_id").val();
				var username 		= $("#add_username").val();
				var password		= $("#add_password").val();
				var konfirmasi 		= $("#add_konfirmasi_password").val();
				var dataString 		= "sekolah_id="+sekolah_id+"&username="+username+"&password="+password+"&konfirmasi="+konfirmasi;
				
				if(password!=konfirmasi){
					alert("konfirmasi password salah.");
					$("#loading_simpan").html('');
					return false;
				}
					$.ajax({
							type: "POST",
							url: "<? echo Yii::app()->createUrl('home/simpan_user');?>",
							data: dataString,
							cache: false,
							success: function(html){
								list_user();
								$("#loading_simpan").html('');
								$("#form_action").hide();
								alert(html);
								
							} 
						}
					);
			}	
			
			function list_user(){
				$("#loading").html('<img src="<? echo Yii::app()->baseUrl?>/images/loading.gif" width="20" heigt="20"/>');
				var sekolah_id 	= $("#sekolah_id").val();
				
					$.ajax({
							type: "POST",
							url: "<? echo Yii::app()->createUrl('home/view_user');?>",
							data: "sekolah_id="+sekolah_id,
							cache: false,
							success: function(html){
								
								$("#daftar_user").html(html);
								$("#loading").html('');
								$("#form_action").hide();
							} 
						}
					);
			}	
			function edit_user(id){
				$("#loading_"+id).html('<img src="<? echo Yii::app()->baseUrl?>/images/loading.gif" width="20" heigt="20"/>');
				
					$.ajax({
							type: "POST",
							url: "<? echo Yii::app()->createUrl('home/edit_user');?>",
							data: "pos_user_id="+id,
							cache: false,
							success: function(html)
							{
								$("#form_action").show();
								$("#view_form_action").html(html);
								$("#loading_"+id).html('');
							} 
						}
					);
			}
			
			function update_user(id){
				$("#loading_"+id).html('<img src="<? echo Yii::app()->baseUrl?>/images/loading.gif" width="20" heigt="20"/>');
				var username 	= $("#edit_username").val();
				var password 	= $("#edit_password").val();
				var konfirmasi 	= $("#konfirmasi_password").val();
				var id 		 	= $("#pos_user_id").val();
				
				if(password!=konfirmasi){
					alert("konfirmasi password salah.");
					$("#loading_"+id).html('');
					return false;
				}
					$.ajax({
							type: "POST",
							url: "<? echo Yii::app()->createUrl('home/update_user');?>",
							data: "id="+id+"&username="+username+"&password="+password+"&konfirmasi="+konfirmasi,
							cache: false,
							success: function(html)
							{
								$("#loading_"+id).html('');
									alert(html);
									list_user();
								$("#form_action").hide();
							} 
						}
					);
			}
			
			function delete_user(id){
				
				var username 	= $("#pos_user_username_"+id).val();
							
				if(!confirm('Apakah anda akan menghapus user ' +username+ ' ?')){
			      return false;
			    }	
				$("#loading_delete"+id).html('<img src="<? echo Yii::app()->baseUrl?>/images/loading.gif" width="20" heigt="20"/>');
				
					$.ajax({
							type: "POST",
							url: "<? echo Yii::app()->createUrl('home/delete_user');?>",
							data: "id="+id,
							cache: false,
							success: function(html){	
								$("#loading_delete"+id).html('');
								list_user();
							} 
						}
					);
			}
			function batal(){	
				$.ajax({
					type: "POST",
					cache: false,
					success: function(html){	
						$("#form_action").hide();
					} 
				});
			}
	</script>
