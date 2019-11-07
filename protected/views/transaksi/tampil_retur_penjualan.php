<form id="form_returjual" method="POST">
<div class="row" style="min-height:850px;width:1110px;margin-top:20px">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
					<h3 class="box-title"><i class="fa fa-cubes"></i> Retur Penjualan</h3>
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
                                <select name="toko" id="toko" onchange="daftar_retur()" class="form-control">
                                    <option value=""> Pilih Toko </option>
                                    <?  $toko_login  = $this->GetSekolahId(); 
                                        $cr_toko            = new CDbCriteria;
                                        if($toko_login !='00'){
                                        $cr_toko->condition = "no_id='".$toko_login."'";}
                                        $modtoko            = TbToko::model()->findAll($cr_toko);
                                        foreach($modtoko as $data){?>
                                    <option value="<?=$data->no_id; ?>"> <? echo $data->toko;?> </option>
                                    <?}?>
                                </select> &nbsp;
                            </td>
                            <td width="5%">&nbsp;</td>
                            <td>
                                <input type="text" name="kode" onkeyup="cari_nama();" id="kode" class="form-control" placeholder="Kode Barang">
                                &nbsp;
                            </td>
                            <td>&nbsp;</td>
                            <td>
                                <input type="text" style="width:320px" readonly name="nama" id="nama" class="form-control"> &nbsp;
                            </td>
                            <td>&nbsp;</td>
                            <td><a onclick="simpan();" class="btn btn-flat btn-info"><i class="fa fa-ok"></i> simpan</a>&nbsp;</td>
                        </tr>
                        <tr>
                            <td>
                                <input type="date" class="form-control" name="date" id="date">
                            </td>
                            <td>&nbsp;</td>
                            <td>
                                <input type="text" class="form-control" style="width:280px" name="faktur" id="faktur" placeholder="nomor faktur">             
                            </td>
                            <td>&nbsp;</td>
                            <td>
                                <input type="text"  style="width:100px" name="jml" id="jml" class="form-control" placeholder="Jml Barang" onkeyup="Numeric(event);">
                            </td>
                            <td>&nbsp;</td>
                            <td><textarea name="alasan" class="form-control" id="alasan"></textarea></td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <span  id="loading"></span>
        <div class="box">
            <div class="box-body"><span id="loading"></div>
                <div class="form-group"  id="daftar_retur" ></div>
            </div>
        </div>
</div>
</form>

	<script type="text/javascript">
    window.onload= function(){
        daftar_retur();
    }
    function Numeric(evt) {
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))

        return false;
        return true;
    }

    function daftar_retur(){
        $("#loading").html('<img src="<? echo Yii::app()->baseUrl?>/images/loading.gif" width="20" heigt="20"/>');

        $.ajax({
            type: "POST",
            url: "<? echo Yii::app()->createUrl('transaksi/tampildaftar_retur');?>",
            data: "toko="+$("#toko").val(),
            cache: false,
            success:function(html){
                $("#daftar_retur").html(html);
                $("#loading").html('');
        
            }
        });
    }

    function simpan(){
        var faktur 		    = $("#faktur").val();
        var toko     		= $("#toko").val();
        var tanggal 		= $("#date").val();
        var kode     		= $("#kode").val();
        var jml      		= $("#jml").val();
        var nama     		= $("#nama").val();
        var alasan          = $("#alasan").val();

        var data            = " toko="+toko+
                                "&faktur="+faktur+
                                "&tanggal="+tanggal+
                                "&kode="+kode+
                                "&barang="+nama+
                                "&jml="+jml+
                                "&alasan="+alasan;

        if(toko==''){
            alert('Toko belum dipilih ');

            return false;
        }
        
        if(faktur==''){
            alert('Nomor Faktur belum diisi ');

            return false;
        }
        
        if(tanggal==''){
            alert('Tanggal belum diisi ');

            return false;
        }


        if(kode==''){
            alert('Kode Barang belum diisi ');

            return false;
        }

        if(alasan==''){
            alert(' Keterangan retur belum diisi ');

            return false;
        }

        if(jml==''){
            alert('Jumlah Barang belum diisi ');

            return false;
        }

        if(nama==''){
            alert(' Barang tidak ditemukan');

            return false;
        }

        $("#loading").html('<img src="<? echo Yii::app()->baseUrl?>/images/loading.gif" width="20" heigt="20"/>');
        
        $.ajax({
            type: "POST",
            url: "<? echo Yii::app()->createUrl('transaksi/simpan_returjual');?>",
            data: data,
            cache: false,
            success:function(html){
                daftar_retur();
                $("#kode").val('');
                $("#nama").val('');
                $("#jml").val('');
                $("#alasan").val('');
                $("#loading").html('');		
                $('#kode').focus();	
            }
        });
    }
    
    function batal_retur(id){
        var kode    = $("#pilih_"+id).val();
        var toko    = $("#toko").val();
        if (confirm('Lanjut menghapus daftar retur ?')) {
            $.ajax({
                type: "POST",
                url: "<? echo Yii::app()->createUrl('transaksi/batal_returjual');?>",
                data: "kode="+kode+"&toko="+toko,
                cache: false,
                success:function(html){
                    daftar_retur();
                }
            });
        }
    }
    
    function cari_nama(){
        var kode = $("#kode").val();
        var toko = $("#toko").val();
        $.ajax({
            type: "POST",
            url: "<? echo Yii::app()->createUrl('transaksi/cari_nama_barang');?>",
            data: "kode="+kode+"&toko="+toko,
            cache: false,
            success:function(html){
                $("#nama").val(html);
            }
        });
    }

    function proses_returjual(){
       
        $.ajax({
            type: "POST",
            url: "<? echo Yii::app()->createUrl('transaksi/proses_returpenjualan');?>",
            data: $("#form_returjual").serialize(),
            cache: false,
            success:function(html){
                alert('sukses');
            }
        });
    }
</script>
