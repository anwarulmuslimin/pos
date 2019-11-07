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
                        <div class="col-md-3">
                            <div class="form-group"  class="col-md-3">
					            <label>&nbsp;</label>
					            <input type="text" class="form-control" name="nama_item" id="nama_item" placeholder="Nama Item ..."  class="col-md-3">
			                 </div>
                        </div>
			            <div class="col-md-3">
				            <div class="form-group"  class="col-md-3">
					            <label>Kategori</label>
                                <select class="form-control" class="col-md-3" name="nama_kategori" id="nama_kategori">
                                    <option value="">Semua Kategori</option>
                                    <? foreach($modkategori as $data){?>
                                    <option value="<? echo $data->pos_kategori_id; ?>"><? echo $data->pos_kategori_nama; ?></option>
                                    <?}?>
                                </select>
				            </div>
                        </div>
			            <div class="col-md-3">
				            <div class="form-group"  class="col-md-3">
					 		    <label>&nbsp;</label><br/>
					            <a class="btn btn-bni" onclick="kelola_item();"><i class="fa fa-search"></i> Cari</a>
				            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		<span id="loading_update"> </span><span id="loading"> </span>
        <div class="col-xs-12" id="daftar_kelola"></div>
    </div>
</section>
<script type="text/javascript">  
	window.onload= function(){
        kelola_item();
    }
	function kelola_item(page,limit){
		$("#loading").html('<img src="<? echo Yii::app()->baseUrl?>/images/loading.gif" width="20" heigt="20"/> sedang memuat data...');
        var nama_item 	= $("#nama_item").val();
        var kategori 	= $("#nama_kategori").val();
        var data 		=  "kategori="+kategori+"&nama_item="+nama_item+'&page='+page+'&limit='+limit;
    
        $.ajax({
            type: "POST",
            url: "<? echo Yii::app()->CreateUrl('items/tampil_kelolaitems');?>",
            data: data,
            cache: false,
            success: function(html){
                
                $("#daftar_kelola").html(html);
                $("#loading").html('');
            } 
        });
    }	
	
    function delete_item(id){
        var id_item 	= $("#id_item_"+id).val();
        var nama_item 	= $("#nama_item_"+id_item).val();
        if(!confirm('Apakah anda akan menghapus Item ' +nama_item+ ' ?')){
            return false;
        }
        $("#loading_delete_"+id).html('<img src="<? echo Yii::app()->baseUrl?>/images/loading.gif" width="20" heigt="20"/>');
        $.ajax({
            type: "POST",
            url: "<? echo Yii::app()->createUrl('items/delete_dataitem');?>",
            data: "pos_item_id="+id_item,
            cache: false,
            success: function(html){
                alert(html);
                kelola_item();
                $("#loading_delete_"+id).html('');
            } 
        });
    }			
	</script>
