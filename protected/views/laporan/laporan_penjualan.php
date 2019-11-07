
<section class="content">
	<div class="row"  style="width:1110px">
	   <div class="col-xs-12">
	  <div class="box box-default">
        <div class="box-header with-border">
			<h3 class="box-title"><i class="fa fa-cubes"></i> Laporan Penjualan</h3>
			<div class="box-tools pull-right">
				<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
			</div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-md-3">
				<div class="form-group">
					<label>Toko:</label>
					<select name="toko" id="toko" onchange="tampil_laporan();" class="form-control">
						<option value=""> Pilih Toko</option>
						<?	$crt 			= new CDbCriteria;
							if($this->GetSekolahId() !='00'){
							$crt->condition = "no_id='".$this->GetSekolahId()."'";}
							$modtoko 		= TbToko::model()->findAll($crt);
						foreach($modtoko as $toko){	?>
						<option value="<? echo $toko->no_id; ?>"> <? echo $toko->toko;?> </option>
						<?}?>
					</select>
					
				</div>
            </div>
			<div class="col-md-3">
				<div class="form-group">
					<label>Kategori Laporan:</label>
					<select name="kategori" id="kategori" onchange="tampil_laporan();" class="form-control">
						<option value=""> Pilih Kategori</option>
						<option value="RP"> Rekap Penjualan </option>
						<option value="RPN"> Rekap Penjualan (Nota) </option>
						<option value="RPD"> Rekap Penjualan (Detail) </option>
						<option value="RK"> Rekap Kasir </option>
						<option value="RL"> Rekap Laba/Rugi </option>
						<option value="RT"> Rekap Barang Terlaris </option>
					</select>
					
				</div>
            </div>
			<div class="col-md-3">
				<div class="form-group"  class="col-md-3">
					 
					  <label>&nbsp;</label><br/>
					  <a class="btn btn-bni" onclick="tampil_laporan();"><i class="fa fa-search"></i> Lihat</a>
					   <span id="link_laporan_barang"></span>
				</div>
              <!-- /.form-group -->
            </div>
          </div>
          <!-- /.row -->
        </div>
      </div>
      </div>
		<span id="loading_penjualan"> </span>
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title"><i id="loading"></i> <b>Daftar Laporan</b></h3>
				</div>
				<div class="box-body">
					<table id="daftar_laporan_penjualan" class="table table-bordered table-hover table-condensed" ></table>
				</div>
			</div>
		</div>
      </div>
</section>

<script type="text/javascript">  
	function tampil_laporan(){
		var date 		= $("#datepicker").val();
		var dataString 	= "date="+date;
		
		$("#loading_penjualan").html('<img src="<? echo Yii::app()->baseUrl?>/images/loading.gif" width="20" heigt="20"/>');
		$.ajax({
			type: "POST",
			url: "<? echo Yii::app()->createUrl('laporan/laporan_penjualan');?>",
			data: dataString,
			cache: false,
			success: function(html){
				link_download();
				$("#daftar_laporan_penjualan").html(html);
				$("#loading_penjualan").html('');
			} 
		});
	}		
	
	
	function link_download(){
		var date 		= $("#datepicker").val();
		var dataString 	= "date="+date;
		
		$.ajax({
			type: "POST",
			url: "<? echo Yii::app()->createUrl('laporan/link_laporan_penjualan');?>",
			data: dataString,
			cache: false,
			success: function(html){
				$("#link_laporan_penjualan").html(html);
			} 
		});
	}	
	</script>