<section class="content">
	<div class="row" style="min-height:850px;width:1110px">
		<div class="col-xs-12">
			<div class="box box-default">
				<div class="box-header with-border">
					<h3 class="box-title"><i class="fa fa-search"></i> Pencarian Supplier</h3>
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
								<input type="text" name="nama_supplier" id="nama_supplier" onkeyUp="list_supplier();" id="nama_kategori" class="form-control" placeholder="Ketikan Nama Kategori">
							</div>
						</div>
						<div class="col-md-3">
							<div class="btn-group">
								<label>&nbsp;</label><br/>
								<a class="btn btn-bni" onclick="list_supplier();"><i class="fa fa-search"></i> Cari</a>
								<a class="btn btn-bni" data-toggle="modal" data-target="#modal-info"> Tambah Supplier </a>
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
											<h4 class="modal-title">Tambah Supplier</h4>
										</div>
										<div class="modal-body">
											<label>Kode Supplier</label>
											<input type="text" class="form-control" id="kode" name="kode" placeholder="Kode Supplier ..."  class="col-md-3">
											<label>Nama Supplier</label>
											<input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Supplier ..."  class="col-md-3">
											<label>Alamat Supplier</label>
											<textarea type="text" class="form-control" id="alamat" name="alamat"  class="col-md-3"></textarea>
											<label>Telp Supplier</label>
											<input type="text" class="form-control" id="telp" name="telp" onkeypress="return Numeric(event)"  class="col-md-3"/>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-bni pull-left" data-dismiss="modal">Batal</button>
											<a onclick="simpan_supplier();" data-dismiss="modal" class="btn btn-bni">Simpan </a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="modal modal-default fade" id="modal-edit">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title">Edit Supplier</h4>
					</div>
					<div id="modal_body_edit"></div>
				</div>
			</div>
		</div>
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title"><i id="loading"></i> Daftar Supplier</h3>
				</div>
				<div class="box-body" id="daftar_supplier" ></div>
				<div class="box-footer"></div>
			</div>
		</div>
	</div>
</section>

<script type="text/javascript">  
	window.onload= function()
	{
		list_supplier();
	}

    function Numeric(evt) {
			var charCode = (evt.which) ? evt.which : event.keyCode
			if (charCode > 31 && (charCode < 48 || charCode > 57))
			return false;
			return true;
	}

	function list_supplier(page,limit){
		$("#loading").html('<img src="<? echo Yii::app()->baseUrl?>/images/loading.gif" width="20" heigt="20"/>');
		var supplier 	= $("#nama_supplier").val();
		var data        = "supplier="+supplier+'&page='+page+'&limit='+limit;
        
		$.ajax({
			type	: "POST",
			url		: "<? echo Yii::app()->createUrl('kategori/view_supplier');?>",
			data	: data,
			cache	: false,
			success	: function(html){
				$("#daftar_supplier").html(html);
				$("#loading").html('');
			} 
		});
	}	

	function simpan_supplier(){
		var kode 	= $("#kode").val();
		var nama 	= $("#nama").val();
		var alamat 	= $("#alamat").val();
		var telp 	= $("#telp").val();
		var data 	= "kode="+kode+"&nama="+nama+"&alamat="+alamat+"&telp="+telp;

		$.ajax({
			type	: "POST",
			url		: "<? echo Yii::app()->createUrl('kategori/simpan_supplier');?>",
			data	: data,
			cache	: false,
			success	: function(html){
				alert(html);
				list_supplier();
			} 
		});
	}			

	function update_supplier(){
		var id_supplier	= $("#update_supplier_id").val();
		var supplier 	= $("#update_supplier").val();
		var alamat  	= $("#alamat_update_supplier").val();
		var telp  		= $("#telp_update_supplier").val();
		var data 		= "supplier="+supplier+"&id="+id_supplier+"&alamat="+alamat+"&telp="+telp;

		$.ajax({
			type	: "POST",
			url		: "<? echo Yii::app()->createUrl('kategori/update_supplier');?>",
			data	: data,
			cache	: false,
			success	: function(html){
				alert(html);
				list_supplier();
			} 
		});
	}	

	function edit_supplier(id){
		$("#loading_edit").html('<img src="<? echo Yii::app()->baseUrl?>/images/loading.gif" width="20" heigt="20"/>');
		$.ajax({
			type	: "POST",
			url		: "<? echo Yii::app()->createUrl('kategori/edit_supplier');?>",
			data	: "id="+id,
			cache	: false,
			success	: function(html){
				
				$("#modal_body_edit").html(html);
				$("#loading_edit").html('');
			} 
		});
	}

	function delete_supplier(id){
		$("#loading_delete_"+id).html('<img src="<? echo Yii::app()->baseUrl?>/images/loading.gif" width="20" heigt="20"/>');
		var kategori 	= $("#nama_supplier_hapus_"+id).val();			
		
		if(!confirm('Apakah anda akan menghapus Supplier ' +kategori+ ' ?')){

			$("#loading_delete_"+id).html('');
			return false;
		}
		
		$.ajax({
			type	: "POST",
			url		: "<? echo Yii::app()->createUrl('kategori/delete_supplier');?>",
			data	: "id="+id,
			cache	: false,
			success	: function(html){
				alert(html);
				$("#loading_delete_"+id).html('');
				list_supplier();
			} 
		});
	}	
</script>