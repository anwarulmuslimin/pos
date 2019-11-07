    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 style="text-align:center;">
        Profil POS
      </h1>
    </section>
	<? 	$cr_profil 				= new CDbCriteria;
		$cr_profil->condition 	= "pos_profil_sekolah_id='".$this->GetSekolahId()."'";
		$profil_Sekolah 		= PosProfil::model()->find($cr_profil);
	?>

    <!-- Main content -->
    <section class="content">

      <div class="row"   style="min-height:850px">
        <div class="col-md-3"> &nbsp; </div>
        <div class="col-md-6">

          <!-- Profile Image -->
          <div class="box box-bni">
            <div class="box-body box-profile">
              <img id="photos" class="profile-user-img img-responsive img-circle" src="<?php echo Yii::app()->request->baseUrl; ?>/images/logo/<? echo $profil_Sekolah->pos_profil_logo;?>" alt="User profile picture">

              <h3 class="profile-username text-center"><? echo $profil_Sekolah->pos_profil_nama;?> <span id="loading_edit"></span></h3>

              	<p class="text-muted text-center">
					<a onclick="edit_logo(<? echo $this->GetSekolahId();?>);" style="cursor:pointer;">
						<i class="fa fa-edit"></i> edit logo 
					</a>
				</p>
				<div id="tampiledit_logo"></div>
              <ul class="list-group list-group-unbordered" id="tampil_profil"> <span id="loading_tampil"></span></ul>
              <a class="btn btn-bni btn-block" onclick="edit_profil(<? echo $this->GetSekolahId();?>);" style="cursor:pointer;" data-toggle="modal" data-target="#modal_edit"><i class="fa fa-edit"></i><b> edit</b></a>
            </div>
          </div>
        </div>
		<div class="col-md-3"> &nbsp; </div>
      </div>
    </section>
	<div class="modal modal-default fade" id="modal_edit_logo">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Edit Logo <span id="loading_edit_logo"></span> </h4>
				</div>
				<div class="modal-body"  id="bodyedit_logo"></div>
			</div>
		</div>
	</div>
	
	<div class="modal modal-default fade" id="modal_edit">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Edit Profil <span id="loading_edit"></span> </h4>
				</div>
				<div class="modal-body"  id="bodyedit"></div>
				<div class="modal-footer">
					<button type="button" class="btn btn-bni pull-left" data-dismiss="modal">Batal</button>
					<a onclick="update_profil(<? echo $this->GetSekolahId();?>);" data-dismiss="modal" class="btn btn-bni">Simpan </a>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript">
    <!-- Start Upload -->
    function startUpload(){
		$("#photos").html("loading...");
		
	}

    function displayPicture(pictureUrl){
        var img = new Image();
        $(img).load(function(){
        $(this).hide();
        $("#photos").html($(this));
        $(this).fadeIn();
        }).attr('src', pictureUrl)
        .error(function(){
            alert("gagal menampilkan gambar");
        });
    }
	</script>
	
	<script type="text/javascript">  
		window.onload= function()
		{
			tampil_profil();
		}
		
		function edit_profil(id){
			$("#loading_edit").html('<img src="<? echo Yii::app()->baseUrl?>/images/loading.gif" width="20" heigt="20"/>');
			$.ajax({
				type: "POST",
				url: "<? echo Yii::app()->createUrl('profil/edit_profil');?>",
				data: "id="+id,
				cache: false,
				success: function(html){
					$("#bodyedit").html(html);
					$("#loading_edit").html('');
				} 
			});
		}		
		
		function edit_logo(id){
			$.ajax({
				type: "POST",
				url: "<? echo Yii::app()->createUrl('profil/edit_logo');?>",
				data: "id="+id,
				cache: false,
				success: function(html){
					$("#tampiledit_logo").html(html);
				} 
			});
		}		
		
		function update_profil(id){
			var nama 			= $("#nama").val();
			var alamat 			= $("#alamat").val();
			var telp 			= $("#telp").val();
			var idsekolah		= $("#id_sekolah").val();
			
			var dataString 		= "nama="+nama+"&alamat="+alamat+"&telp="+telp+"&idsekolah="+idsekolah+"&id="+id;
			
			$.ajax({
				type: "POST",
				url: "<? echo Yii::app()->createUrl('profil/update_profil');?>",
				data: dataString,
				cache: false,
				success: function(html){
					alert(html);
					tampil_profil();
				} 
			});
		}		
		
		function tampil_profil(){
			$("#loading_tampil").html('<img src="<? echo Yii::app()->baseUrl?>/images/loading.gif" width="20" heigt="20"/>');
			$.ajax({
				type: "POST",
				url: "<? echo Yii::app()->createUrl('profil/tampil_profil');?>",
				cache: false,
				success: function(html){
					$("#tampil_profil").html(html);
					$("#loading_tampil").html('');
				} 
			});
		}		
	</script>