<input type="hidden" name="toko" id="toko" class="form-control" value="<? echo $toko?>"/><br/>
<div class="row" style="min-height:850px;width:1110px">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
					<h3 class="box-title"><i class="fa fa-cubes"></i> Retur Pembelian</h3>
					<div class="box-tools pull-right">
						<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
						<a href="#" data-toggle="modal" onclick="loadManualBook(5)" data-target="#myModalBantuan" class="pull-right" title="Klik Bantuan"><i class="fa fa-question-circle fa-2x"></i></a>
					</div>
        		</div>
            <div class="box-body">
                <div class="input-group margin">
                    <table width="100%">
                        <tr>
                            <td colspan="3">
                                <select name="supplier" id="supplier" style="width:320px;" class="form-control" onchange="view_returan();">
                                    <option value="">Non Supplier</option>
                                    <?  $crs            = new CDbCriteria;
                                        $crs->select    = "Supplier";
                                        $crs->group     = "Supplier";
                                        $modsupplier = Returnbarangtemp::model()->findAll($crs);?>
                                    <? foreach($modsupplier as $data){?>
                                        <?if($data->Supplier!=''){?>
                                            <option value="<? echo $data->Supplier; ?>"><? echo $this->GetNamaSupplier($data->Supplier);?></option>
                                        <?}?>
                                    <?}?>
                                </select> &nbsp;
                            </td>
                            <td>&nbsp;</td>
                            <td>
                                <input type="text" style="width:320px;" name="nofaktur" id="nofaktur" placeholder="ketikan Nomor Faktur" class="form-control">&nbsp;
                            </td>
                        </tr>
                        <tr>
                             <td colspan="4">&nbsp;</td>
                        </tr>
                        <tr>
                            <td>
                                <input type="date" class="form-control" name="date" id="date">
                            </td>
                            <td>&nbsp;</td>
                            <td>
                                <a href="javascript::view" onclick="daftar_returbeli();" class="btn btn-flat btn-info"><i class="fa fa-refresh"></i>  tampil</a>
                            </td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div><span  id="loading"></span>
        <div class="box">
            <div class="box-body"><span id="loading"></div>
                <div class="form-group"  id="daftar_retur_temp" > </div>
            </div>
        </div>
    </div>
</div>


	<script type="text/javascript">
    window.onload= function(){
        view_returan();
    }

    function view_returan(){
        $("#loading").html('<img src="<? echo Yii::app()->baseUrl?>/images/loading.gif" width="20" heigt="20"/>');

        $.ajax({
            type: "POST",
            url: "<? echo Yii::app()->createUrl('transaksi/daftar_returpembelian');?>",
            data: "supplier="+$("#supplier").val(),
            cache: false,
            success:function(html){
                $("#daftar_retur_temp").html(html);
                $("#loading").html('');
        
            }
        });
    }

    function proses_returpembelian(){
       
        $.ajax({
            type: "POST",
            url: "<? echo Yii::app()->createUrl('transaksi/proses_returpembelian');?>",
            data: $("#form_returjual").serialize(),
            cache: false,
            success:function(html){
                alert('sukses');
            }
        });
    }
</script>
