<section class="content">
	<div class="row" style="min-height:850px;width:1110px">
		<div class="col-xs-12">
			<div class="box box-default">
				<div class="box-header with-border">
					<h3 class="box-title"><i class="fa fa-search"></i> Pencarian</h3>
					<div class="box-tools pull-right">
						<a href="#" data-toggle="modal" onclick="loadManualBook(1)" data-target="#myModalBantuan" class="pull-right" title="Klik Bantuan"><i class="fa fa-question-circle fa-2x"></i></a>
						<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>&nbsp;&nbsp;&nbsp;&nbsp;
					</div>
				</div>
				<div class="box-body">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group"  class="col-md-6">
								<label>&nbsp;</label>
								<input type="text" name="nama_kategori" onkeyUp="list_kategori();" id="nama_kategori" class="form-control" placeholder="Ketikan Nama Kategori">
							</div>
						</div>
						<div class="col-md-3">
							<div class="btn-group">
								<label>&nbsp;</label><br/>
								<a class="btn btn-bni" onclick="list_kategori();"><i class="fa fa-search"></i> Cari</a>
								<a class="btn btn-bni" data-toggle="modal" data-target="#modal-info"> Tambah Kategori </a>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group"  class="col-md-3" style="align:right;">
								<label>&nbsp;</label><br/>
								<div class="btn-group" >
									
								</div>
							</div>
							<div class="modal modal-default fade" id="modal-info">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span></button>
											<h4 class="modal-title">Tambah Kategori</h4>
										</div>
										<div class="modal-body">
											<label>Nama Kategori</label>
											<input type="text" class="form-control" id="add_kategori" name="add_kategori" placeholder="Nama Kategori ..."  class="col-md-3">
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-bni pull-left" data-dismiss="modal">Batal</button>
											<a onclick="simpan_kategori();" data-dismiss="modal" class="btn btn-bni">Simpan </a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title"><i id="loading"></i> Daftar Kategori </h3>
				</div>
				<div class="box-body" id="daftar_kategori" ></div>
				<div class="box-footer"></div>
			</div>
		</div>
	</div>
</section>
<div class="modal modal-default fade" id="modal-edit">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title"><span id="loading_edit"></span> Edit Kategori</h4>
			</div>
			<div class="modal-body-edit" id="modal-body-edit"></div>
			<div class="modal-footer">
				<button type="button" class="btn btn-bni pull-left" data-dismiss="modal"><i class="fa fa-remove"></i> Batal</button>
				<a onclick="update_kategori();" data-dismiss="modal" class="btn btn-bni"><i class="fa fa-check"></i> Simpan</a>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">  
	window.onload= function()
	{
		list_kategori();
	}
	function list_kategori(){
		$("#loading").html('<img src="<? echo Yii::app()->baseUrl?>/images/loading.gif" width="20" heigt="20"/>');
		var kategori 	= $("#nama_kategori").val();
		
		$.ajax({
			type	: "POST",
			url		: "<? echo Yii::app()->createUrl('kategori/view_kategori');?>",
			data	: "kategori="+kategori,
			cache	: false,
			success	: function(html){
				$("#daftar_kategori").html(html);
				$("#loading").html('');
			} 
		});
	}	

	function simpan_kategori(){
		var kategori 	= $("#add_kategori").val();
		
		$.ajax({
			type	: "POST",
			url		: "<? echo Yii::app()->createUrl('kategori/add_kategori');?>",
			data	: "kategori="+kategori,
			cache	: false,
			success	: function(html){
				list_kategori();
			} 
		});
	}			

	function update_kategori(){
		var id_kategori	= $("#update_kategori_id").val();
		var kategori 	= $("#update_kategori").val();
		
		$.ajax({
			type	: "POST",
			url		: "<? echo Yii::app()->createUrl('kategori/update_kategori');?>",
			data	: "kategori="+kategori+"&id="+id_kategori,
			cache	: false,
			success	: function(html){
				list_kategori();
			} 
		});
	}	

	function edit_kategori(id){
		$("#loading_edit").html('<img src="<? echo Yii::app()->baseUrl?>/images/loading.gif" width="20" heigt="20"/>');

		$.ajax({
			type	: "POST",
			url		: "<? echo Yii::app()->createUrl('kategori/edit_kategori');?>",
			data	: "id="+id,
			cache	: false,
			success	: function(html){
				$("#modal-body-edit").html(html);
				$("#loading_edit").html('');
			} 
		});
	}

	function delete_kategori(id){
		$("#loading_delete_"+id).html('<img src="<? echo Yii::app()->baseUrl?>/images/loading.gif" width="20" heigt="20"/>');
		var kategori 	= $("#nama_kategori_hapus_"+id).val();			
		
		if(!confirm('Apakah anda akan menghapus Kategori ' +kategori+ ' ?')){
			return false;
			$("#loading_delete_"+id).html('');
		}
		
		$.ajax({
			type	: "POST",
			url		: "<? echo Yii::app()->createUrl('kategori/delete_kategori');?>",
			data	: "id="+id,
			cache	: false,
			success	: function(html){
				$("#loading_delete_"+id).html('');
				list_kategori();
			} 
		});
	}	
</script>