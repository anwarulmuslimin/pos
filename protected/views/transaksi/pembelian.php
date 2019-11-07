<input type="hidden" name="toko" id="toko" class="form-control" value="<? echo $toko?>"/><br/>
<div class="row" style="min-height:850px;width:1110px">
    <div class="col-md-12">
        <div class="box">
            <div class="box-body">
                <div class="input-group margin">
                    <select class="form-control" style="width:320px;" name="supplier" id="supplier" onchange="lihat_daftarpembelian();">
                        <option value=""> Pilih supplier</option>
                        <? $supplier = Supplier::model()->findAll();?>
                        <? foreach($supplier as $data){?>
                        <option value="<? echo $data->no_id;?>"><? echo $data->perusahaan; ?></option>
                        <?}?>
                    </select>
                    <input type="text" name="faktur" id="faktur" class="form-control" style="width:320px;" placeholder=" Ketikan Nomor Faktur" onkeyup="lihat_daftarpembelian();">
                    <input type="date" name="date" id="date" class="form-control" style="width:180px;">
                    <a class="btn btn-info btn-flat" onclick="tambah_pembelian();"><i class="fa fa-plus"></i> Pembelian</a>	
                    <a class="btn btn-success btn-flat" onclick="lihat_daftarpembelian();"><i class="fa fa-refresh"></i> refresh</a>	
                </div><table id="tampil_item" class="table table-condensed table-hover" width="100%"></table>
            </div>
        </div><span  id="loading"></span>
        <div class="modal modal-default fade" id="modal-tambah">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Tambah Pembelian</h4>
                    </div>
                    <div class="modal-body">						
                        <div class="input-group margin">
                            
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="box" id="tambah_pembelian" style="display:none;">
            <div class="box-body">
            <a onclick="sembunyikan();" class="pull-right" title="Klik Hidden"><i class="fa fa-remove"></i></a>			
                <div class="input-group margin">
                <table class="table table-condensed table-hover" width="100%">
                    <tr>
                        <td><input style="height:32px;width:150px;" type="text" class="form-control" id="kode" name="kode" onkeypress="cek_kode();" placeholder="Kode Barang"></td>
                        <td><input style="height:32px;width:400px" type="text" class="form-control" id="nama" name="nama" placeholder="Nama Barang"></td>
                        <td><input style="height:32px;width:250px" type="text" class="form-control" id="h_beli" name="h_beli" placeholder="Harga Beli Barang"></td>
                        <td><input style="height:32px;width:100px" type="text" class="form-control" id="jml" name="jml" placeholder="Jumlah"></td>
                        <td>
                            <a class="btn btn-bni btn-flat" onclick="simpan();" id="btn2Search">
                            <i class="fa fa-ok"></i> Simpan</a>
                        </td>
                    </tr>
                </table>
                </div>
            </div>
        </div>
        <div class="box">
            <div class="box-body"><span id="loading"></div>
                <div class="form-group"  id="daftar_transaksi" >
                </div>
            </div>
        </div>
    </div>
</div>


	<script type="text/javascript">
    window.onload= function(){
       lihat_daftarpembelian();
    }
    function Numeric(evt) {
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))

        return false;
        return true;
    }

    function tambah_pembelian(){
        $("#tambah_pembelian").show();
    }


    function sembunyikan(){
       
        $("#tambah_pembelian").hide();
    }

    function lihat_daftarpembelian(){
        $("#loading").html('<img src="<? echo Yii::app()->baseUrl?>/images/loading.gif" width="20" heigt="20"/>');
        var supplier 		= $("#supplier").val();
        var faktur          = $("#faktur").val();

        $.ajax({
            type: "POST",
            url: "<? echo Yii::app()->createUrl('transaksi/lihat_pembelian');?>",
            data: "supplier="+supplier+"&nofaktur="+faktur,
            cache: false,
            success:function(html){
                $("#daftar_transaksi").html(html);
                $("#loading").html('');
        
            }
        });
    }

    function simpan(){
        var faktur 		    = $("#faktur").val();
        var supplier 		= $("#supplier").val();
        var tanggal 		= $("#date").val();
        var kode     		= $("#kode").val();
        var harga    		= $("#h_beli").val();
        var jml      		= $("#jml").val();
        var nama     		= $("#nama").val();

        var data            = " suplier="+supplier+
                                "&faktur="+faktur+
                                "&tanggal="+tanggal+
                                "&kode="+kode+
                                "&barang="+nama+
                                "&harga="+harga+
                                "&jml="+jml;

        if(supplier==''){
            alert('Supplier belum dipilih ');

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

        if(nama==''){
            alert('Nama Barang belum diisi ');

            return false;
        }

        if(harga==''){
            alert('Nama Barang belum diisi ');

            return false;
        }


        if(jml==''){
            alert('Jumlah Barang belum diisi ');

            return false;
        }

        $("#loading").html('<img src="<? echo Yii::app()->baseUrl?>/images/loading.gif" width="20" heigt="20"/>');
        
        $.ajax({
            type: "POST",
            url: "<? echo Yii::app()->createUrl('transaksi/simpan_pembelian');?>",
            data: data,
            cache: false,
            success:function(html){
                lihat_daftarpembelian();
                $("#kode").val('');
                $("#nama").val('');
                $("#h_beli").val('');
                $("#jml").val('');
                $("#loading").html('');		
                $('#kode').focus();	
            }
        });
    }

    function batal(id){
    
        if (confirm('Lanjut menghapus pembelian ?')) {
            $.ajax({
                type: "POST",
                url: "<? echo Yii::app()->createUrl('transaksi/batalpembelian');?>",
                data: "kode="+id,
                cache: false,
                success:function(html){
                    lihat_daftarpembelian();
                }
            });
        }
    }
</script>