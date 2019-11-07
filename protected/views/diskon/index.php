
<form id="form_diskon" action="" method="POST">
<section class="content">
	<div class="row"  style="min-height:850px;width:1110px">
	   <div class="col-xs-12">
	  <div class="box box-default">
        <div class="box-header with-border">
			<h3 class="box-title"><i class="fa fa-search"></i> Input Diskon</h3>
			<div class="box-tools pull-right">
				<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
				<a href="#" data-toggle="modal" onclick="loadManualBook(4)" data-target="#myModalBantuan" class="pull-right" title="Klik Bantuan"><i class="fa fa-question-circle fa-2x"></i></a>
			</div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
          
          <?if($this->GetStatusUser()=="Admin"){?>
            <div class="col-md-2">
				<div class="form-group">
                    <label>Toko</label>
                    <select name="lokasi" id="lokasi" class="form-control" >
                        <? foreach($toko as $toko){?>
                        <option value="<? echo $toko->no_id; ?>"> <? echo $toko->toko; ?></option>
                        <?}?>
                    </select>
				</div>
            </div>
            <?}else{?>
                <input type="hidden" value="<?=$this->GetSekolahId();?>" name="lokasi" id="lokasi">
            <?}?>
            <div class="col-md-3">
				<div class="form-group">
                    <label>Katagori</label>
                    <select name="kategori" id="kategori" class="form-control" onchange="tampil_barang();">
                        <option value=""> Pilih Katagori Barang</option>
                        <? foreach($modkatagori as $katagori){?>
                        <option value="<? echo $katagori->nama_katagori; ?>"><? echo $katagori->nama_katagori; ?></option>
                        <?}?>
                    </select>
				</div>
            </div>
            <div class="col-md-3">
				<div class="form-group">
					    <label>&nbsp;</label>
						<input class="form-control" name="cari_barang" id="cari_barang" onkeyup="tampil_barang();" placeholder="Ketikan Kode atau Nama Barang..."> 
				</div>
            </div>
			<div class="col-md-3">
				<div class="form-group">
					 
					  <label>&nbsp;</label><br/>
					  <a class="btn btn-bni" onclick="tampil_barang();"><i class="fa fa-search"></i> Cari</a>
					 </div>
              <!-- /.form-group -->
            </div>
          </div>
          <!-- /.row -->
        </div>
      </div>
      </div>
		<span id="loading_diskon"> </span>
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title"><i id="loading"></i> <b>Form Diskon</b></h3>
				</div>
				<div class="box-body">
					<table id="daftar_diskon" class="table table-bordered table-hover table-condensed" ></table>
				</div>
			</div>
		</div>
      </div>
</section>
</form>
<script type="text/javascript">  

    window.onload= function(){
        $('#lokasi').focus();
    }
    function Numeric(evt) {
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))

        return false;
        return true;
    }
    function tampil_daftar_diskon(){
        var lokasi 		= $("#lokasi").val();
        var dataString 	= "lokasi="+lokasi;
        
        $("#loading_diskon").html('<img src="<? echo Yii::app()->baseUrl?>/images/loading.gif" width="20" heigt="20"/>');
        $.ajax({
            type: "POST",
            url: "<? echo Yii::app()->createUrl('diskon/tampil_daftar_diskon');?>",
            data: dataString,
            cache: false,
            success: function(html){
                $("#daftar_diskon").html(html);
                $("#loading_diskon").html('');
            } 
        });
    }	

    function tampil_barang(){
        var id 		    = $("#kategori").val();
        var filter	    = $("#cari_barang").val();
        var lokasi	    = $("#lokasi").val();
        var dataString 	= "katagori="+id+"&filter="+filter+"&lokasi="+lokasi;
        
        $("#loading_diskon").html('<img src="<? echo Yii::app()->baseUrl?>/images/loading.gif" width="20" heigt="20"/>');
        $.ajax({
            type: "POST",
            url: "<? echo Yii::app()->createUrl('diskon/cari_barang');?>",
            data: dataString,
            cache: false,
            success: function(html){
                $("#daftar_diskon").html(html);
                $("#loading_diskon").html('');
            } 
        });
    }	
	
    function simpan_diskon(){ 
        var id 		    = $("#kategori").val();
        var filter	    = $("#cari_barang").val();
        var lokasi	    = $("#lokasi").val();
        var dataString 	= "&katagori="+id+"&filter="+filter+"&lokasi="+lokasi;
       
        $("#loading_diskon").html('<img src="<? echo Yii::app()->baseUrl?>/images/loading.gif" width="20" heigt="20"/>');
        $.ajax({
            type: "POST",
            url: "<? echo Yii::app()->createUrl('diskon/set_diskon');?>",
            data: $("#form_diskon").serialize()+dataString,
            cache: false,
            success: function(html){
               //alert(html);
                //tampil_daftar_diskon();
                $("#loading_diskon").html('');
            } 
        });
    }	
	
</script>