<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box box-default">
				<div class="box-header with-border">
					<h3 class="box-title"><i class="fa fa-search"></i> Pencarian</h3>
					<div class="box-tools pull-right">
						<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
					</div>
				</div>
				<div class="box-body">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group"  class="col-md-6">
								<label>&nbsp;</label>
								<input type="text" name="nama_kategori"  id="nama_kategori" class="form-control" placeholder="Ketikan Nama Kategori">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group"  class="col-md-3">
								<label>&nbsp;</label><br/>
								<a class="btn btn-bni" onclick="kelola_kategori();"><i class="fa fa-search"></i> Cari</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xs-12" id="daftar_kelolakategori"></div>
	</div>
</section>
<script type="text/javascript">  
	window.onload= function(){
        kelola_kategori();
    }
	
	function kelola_kategori(){
		$("#loading").html('<img src="<? echo Yii::app()->baseUrl?>/images/loading.gif" width="20" heigt="20"/>');
		var kategori 	= $("#nama_kategori").val();
		
		$.ajax({
			type	: "POST",
			url		: "<? echo Yii::app()->createUrl('kategori/tampil_kelolakategori');?>",
			data	: "kategori="+kategori,
			cache	: false,
			success	: function(html){
				$("#daftar_kelolakategori").html(html);
				$("#loading").html('');
			} 
		});
	}	

	function delete_kelolakategori(id){
		$("#loading_delete_"+id).html('<img src="<? echo Yii::app()->baseUrl?>/images/loading.gif" width="20" heigt="20"/>');
		var kategori 	= $("#nama_kategori_hapus_"+id).val();			
		
		if(!confirm('Apakah anda akan menghapus Kategori ' +kategori+ ' ?')){
			return false;
			$("#loading_delete_"+id).html('');
		}
		
		$.ajax({
			type	: "POST",
			url		: "<? echo Yii::app()->createUrl('kategori/delete_kelolakategori');?>",
			data	: "id="+id,
			cache	: false,
			success	: function(html){
				$("#loading_delete_"+id).html('');
				kelola_kategori();
			} 
		});
	}	
</script>