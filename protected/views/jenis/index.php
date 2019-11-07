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
								<input type="text" name="nama_jenis" onkeyUp="list_jenis();" id="nama_jenis" class="form-control" placeholder="Ketikan Nama Jenis">
							</div>
						</div>
						<div class="col-md-3">
							<div class="btn-group">
								<label>&nbsp;</label><br/>
								<a class="btn btn-bni" onclick="list_jenis();"><i class="fa fa-search"></i> Cari</a>
								<a class="btn btn-bni" data-toggle="modal" data-target="#modal-info"> Tambah Jenis </a>
							</div>
						</div>
						<div class="col-md-3">
							<div class="modal modal-default fade" id="modal-info">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span></button>
											<h4 class="modal-title">Tambah Jenis</h4>
										</div>
										<div class="modal-body">
											<label>Nama Jenis</label>
											<input type="text" class="form-control" id="add_jenis" name="add_jenis" placeholder="Nama Jenis ..."  class="col-md-3">
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-bni pull-left" data-dismiss="modal">Batal</button>
											<a onclick="simpan_jenis();" data-dismiss="modal" class="btn btn-bni">Simpan </a>
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
					<h3 class="box-title"><i id="loading"></i> Daftar Jenis</h3>
				</div>
				<div class="box-body" id="daftar_jenis" ></div>
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
				<h4 class="modal-title"><span id="loading_edit"></span> Edit Jenis</h4>
			</div>
			<div class="modal-body-edit" id="modal-body-edit"></div>
			<div class="modal-footer">
				<button type="button" class="btn btn-bni pull-left" data-dismiss="modal"><i class="fa fa-remove"></i> Batal</button>
				<a onclick="update_jenis();" data-dismiss="modal" class="btn btn-bni"><i class="fa fa-check"></i> Simpan</a>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">  
	window.onload= function()
	{
		list_jenis();
	}
	function list_jenis(page,limit){
		$("#loading").html('<img src="<? echo Yii::app()->baseUrl?>/images/loading.gif" width="20" heigt="20"/>');
		var jenis 	= $("#nama_jenis").val();
		
		$.ajax({
			type	: "POST",
			url		: "<? echo Yii::app()->createUrl('jenis/view_jenis');?>",
			data	: "jenis="+jenis+"&page="+page+"&limit="+limit,
			cache	: false,
			success	: function(html){
				$("#daftar_jenis").html(html);
				$("#loading").html('');
			} 
		});
	}	

	function simpan_jenis(){
		var jenis 	= $("#add_jenis").val();
		
		$.ajax({
			type	: "POST",
			url		: "<? echo Yii::app()->createUrl('jenis/simpan_jenis');?>",
			data	: "jenis="+jenis,
			cache	: false,
			success	: function(html){
				list_jenis();
			} 
		});
	}			

	function update_jenis(){
		var id_kategori	= $("#update_jenis_id").val();
		var kategori 	= $("#update_jenis").val();
		
		$.ajax({
			type	: "POST",
			url		: "<? echo Yii::app()->createUrl('kategori/update_jenis');?>",
			data	: "kategori="+kategori+"&id="+id_kategori,
			cache	: false,
			success	: function(html){
				list_jenis();
			} 
		});
	}	

	function edit_jenis(id){
		$("#loading_edit").html('<img src="<? echo Yii::app()->baseUrl?>/images/loading.gif" width="20" heigt="20"/>');

		$.ajax({
			type	: "POST",
			url		: "<? echo Yii::app()->createUrl('jenis/edit_jenisi');?>",
			data	: "id="+id,
			cache	: false,
			success	: function(html){
				$("#modal-body-edit").html(html);
				$("#loading_edit").html('');
			} 
		});
	}

	function delete_jenisi(id){
		$("#loading_delete_"+id).html('<img src="<? echo Yii::app()->baseUrl?>/images/loading.gif" width="20" heigt="20"/>');
		var jenis 	= $("#nama_jenis_hapus_"+id).val();			
		
		if(!confirm('Apakah anda akan menghapus Jenis ' +jenis+ ' ?')){
			return false;
			$("#loading_delete_"+id).html('');
		}
		
		$.ajax({
			type	: "POST",
			url		: "<? echo Yii::app()->createUrl('jenis/delete_jenis');?>",
			data	: "id="+id,
			cache	: false,
			success	: function(html){
				$("#loading_delete_"+id).html('');
				list_jenis();
			} 
		});
	}	
</script>