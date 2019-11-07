<form id="formpindahbarang" method="POST">
<section class="content">
	<div class="row" style="min-height:850px;width:1110px">
		<div class="col-xs-12">
			<div class="box box-default">
				<div class="box-header with-border">
					<h3 class="box-title"> </h3>
					<div class="box-tools pull-right">
						<a href="#" data-toggle="modal" onclick="loadManualBook(1)" data-target="#myModalBantuan" class="pull-right" title="Klik Bantuan"><i class="fa fa-question-circle fa-2x"></i></a>
					</div>
				</div>
				<div class="box-body">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group"  class="col-md-6">
								<label>Supplier</label><br/>
								<select name="supplier" id="supplier" onchange="tampil_barang();" class="form-control">
									<option value=""> Pilih Supplier</option>
									<? 	$crp 			= new CDbCriteria;
										$crp->select 	= "supplier,sum(stok_gudang) as stok_gudang";
										$crp->group 	= "supplier";
										$supplier 		= Barang::model()->findAll($crp);?>
									<? foreach($supplier as $data){?>
									<? if($data->stok_gudang > 0){?>
									<option value="<? echo $data->supplier; ?>"><?=++$u;?>. <? echo $this->GetNamaSupplier($data->supplier); ?></option>
									<?}?>
									<?}?>
								</select>
							</div>
						</div>
						
						<div class="col-md-3">
							<div class="btn-group">
								<label>Toko</label><br/>
								<select name="toko" id="toko" onchange="tampil_temp_();"  class="form-control">
									<option value=""> Pilih Toko</option>
									<? $Toko 	= TbToko::model()->findAll();?>
									<? foreach($Toko as $data){?>
									<option value="<? echo $data->no_id; ?>"><? echo $data->toko; ?></option>
									<?}?>
								</select>
							</div>
						</div>
						
					</div>
				</div>
			</div>
			<span id="loading"></span>
		</div>
		
		<div class="col-xs-6">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title"><i id="loading"></i> Daftar Barang</h3>
				</div>
				
				<div class="box-body" id="daftar_stok"> </div>
				<div class="box-footer"></div>
			</div>
		</div>
		<div class="col-xs-1">
			<a onclick="batal_mutasikan();" title="klik untuk membatalkan kirim barang" class="btn btn-danger btn-sm"><i class="fa fa-angle-double-left"></i> </a>
			<a onclick="lanjut_mutasikan();" title="klik untuk mengirim barang ke toko" class="btn btn-success btn-sm"><i class="fa fa-angle-double-right"></i> </a>
		</div>
		<div class="col-xs-5">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title"><i id="loading"></i> Daftar Barang Dikirim</h3>
				</div>
				<div class="box-body" id="daftar_tmpmutasi"></div>
				<div class="box-footer">
					<a id="kirim" class="btn btn-bni" onclick="kirim_toko();"><i class="fa fa-truck"></i> Kirim</a>
				</div>
			</div>
			
		</div>
	</div>
</section>
</form>
<script type="text/javascript">  
	window.onload= function()
	{
		tampil_barang();
		tampil_temp_();
	}


    function Numeric(evt) {
			var charCode = (evt.which) ? evt.which : event.keyCode
			if (charCode > 31 && (charCode < 48 || charCode > 57))
			return false;
			return true;
	}

	function tampil_barang(){
		$("#loading").html('<img src="<? echo Yii::app()->baseUrl?>/images/loading.gif" width="20" heigt="20"/>');
		$.ajax({
			type	: "POST",
			url		: "<? echo Yii::app()->createUrl('kategori/tampil_barang');?>",
			data 	: "supplier="+$("#supplier").val(),
			cache	: false,
			success	: function(html){
				$("#daftar_stok").html(html);
				$("#loading").html('');
			} 
		});
	}	

	function tampil_temp_(){
		$("#loading").html('<img src="<? echo Yii::app()->baseUrl?>/images/loading.gif" width="20" heigt="20"/>');
		$.ajax({
			type	: "POST",
			url		: "<? echo Yii::app()->createUrl('kategori/tampil_tempmutasi');?>",
			data 	: "toko="+$("#toko").val(),
			cache	: false,
			success	: function(html){
				$("#daftar_tmpmutasi").html(html);
				$("#loading").html('');
			} 
		});
	}	

	function lanjut_mutasikan(){
		$("#loading").html('<img src="<? echo Yii::app()->baseUrl?>/images/loading.gif" width="20" heigt="20"/>');
		var toko 		= $("#toko").val();
		var supplier 	= $("#supplier").val();

		if(supplier ==''){
			alert('Supplier harus dipilih terlebih dahulu !');
			$("#loading").html('');
			return false;
			
		}


		if(toko ==''){
			alert('Toko tujuan harus dipilih terlebih dahulu !');

			$("#loading").html('');
			return false;
		}

		$.ajax({
			type	: "POST",
			url		: "<? echo Yii::app()->createUrl('kategori/simpan_tempmutasibarang');?>",
			data 	: $("#formpindahbarang").serialize(),
			cache	: false,
			success	: function(html){
				tampil_temp_();
				tampil_barang();
				$("#loading").html('');
			} 
		});
	}

function batal_mutasikan(){
	$("#loading").html('<img src="<? echo Yii::app()->baseUrl?>/images/loading.gif" width="20" heigt="20"/>');

	$.ajax({
		type	: "POST",
		url		: "<? echo Yii::app()->createUrl('kategori/batal_tempmutasibarang');?>",
		data 	: $("#formpindahbarang").serialize(),
		cache	: false,
		success	: function(html){
			tampil_temp_();
			tampil_barang();
			$("#loading").html('');
		} 
	});
}	

function kirim_toko(){
	$("#loading").html('<img src="<? echo Yii::app()->baseUrl?>/images/loading.gif" width="20" heigt="20"/>');

	$.ajax({
		type	: "POST",
		url		: "<? echo Yii::app()->createUrl('kategori/distribusikan');?>",
		data 	: $("#formpindahbarang").serialize(),
		cache	: false,
		success	: function(html){
			$("#cetak-bukti").html('<a class="btn btn-info" href="<? echo Yii::app()->createUrl('kategori/cetak_bukti');?>"><i class="fa fa-print"></i> Cetak</a>');
			$("#loading").html('');
		} 
	});
}		

</script>