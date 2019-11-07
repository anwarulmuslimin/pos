<section class="content">
	<div class="row"  style="min-height:850px;width:1110px">
	<div class="col-xs-12">
	  <div class="box box-default">
        <div class="box-header with-border">
			<h3 class="box-title"><i class="fa fa-search"></i> Pencarian</h3>
			<div class="box-tools pull-right">
				<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
				<a href="#" data-toggle="modal" onclick="loadManualBook(4)" data-target="#myModalBantuan" class="pull-right" title="Klik Bantuan"><i class="fa fa-question-circle fa-2x"></i></a>
			</div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-md-3">
				<div class="form-group">
					<label>Tanggal:</label>
                    <input readonly type="text" class="form-control" value="<? echo $tanggal;?>">
				</div>
            </div>
			<div class="col-md-3">
				<div class="form-group"  class="col-md-3">
					 
					  <label>&nbsp;</label><br/>
					  <a class="btn btn-bni" onclick="tampil_rekapkasir();"><i class="fa fa-search"></i> View</a>
					  <span id="link_rekapkasir"></span>
				</div>
              <!-- /.form-group -->
            </div>
          </div>
          <!-- /.row -->
        </div>
      </div>
      </div>
		<span id="loading_rekap"> </span>
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title"> <b>Rekap Penjualan</b></h3>
				</div>
				<div class="box-body">
					<table id="daftar_rekapkasir" class="table table-bordered table-hover table-condensed" ></table>
				</div>
			</div>
		</div>
      </div>
</section>

<script type="text/javascript">  
	function tampil_rekapkasir(){		
		$("#loading_rekap").html('<img src="<? echo Yii::app()->baseUrl?>/images/loading.gif" width="20" heigt="20"/>');
		$.ajax({
			type: "POST",
			url: "<? echo Yii::app()->createUrl('laporan/view_rekapkasir');?>",
			cache: false,
			success: function(html){
				
				link_download();
				$("#daftar_rekapkasir").html(html);
				$("#loading_rekap").html('');
			} 
		});
	}	
	
	function link_download(){
		var date 		= $("#datefilter").val();
		var dataString 	= "date="+date;
		
		$.ajax({
			type: "POST",
			url: "<? echo Yii::app()->createUrl('laporan/link_rekapkasir');?>",
			data: dataString,
			cache: false,
			success: function(html){
				$("#link_rekapkasir").html(html);
			} 
		});
	}		
	</script>