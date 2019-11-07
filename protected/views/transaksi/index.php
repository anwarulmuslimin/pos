	<input type="hidden" name="toko" id="toko" class="form-control" value="<? echo $toko?>"/><br/>
	<div class="row" style="min-height:850px;width:1110px">
		<div class="col-md-8">
			<div class="box">
				<div class="box-body">
					<div class="input-group margin">
						<input type="text" class="form-control" id="kode_item"  name="kode_item" onkeypress="return Press(event);" placeholder="Masukan Kode Barcode disini">
						<span class="input-group-btn">
							<a class="btn btn-bni btn-flat" id="btnSearch" onclick="lanjut_belanja();"><i class="fa fa-cart-arrow-down"></i></a>
							<!--a class="btn btn-default btn-flat" onclick="cari();"  data-toggle="modal" data-target="#modal-cari"><i class="fa fa-search"></i> Pencarian</a-->
						</span>	
						<a href="#" data-toggle="modal" onclick="loadManualBook(3)" data-target="#myModalBantuan" class="pull-right" title="Klik Bantuan"><i class="fa fa-question-circle fa-2x"></i></a>			
					</div><table id="tampil_item" class="table table-condensed table-hover" width="100%"></table><!--tampil data barang yang akan dibeli-->
				</div>
			</div><span  id="loading"></span>
			<div class="box">
				<div class="box-body">
					<div class="form-group"  id="daftar_transaksi" >
						<table class="table table-hover table-condensed" width="100%">
							<tr>
								<th></th><th>Nama Item</th><th>Harga</th><th>Jumlah</th><th>Diskon</th><th>Jumlah Total</th>
							</tr>
						</table>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="box">
				<div class="box-body">
					<div class="form-group"><h4>TOTAL :</h4><h1 id="total_bayar" style="font-size:bold;color:green">Rp <? echo $this->Uang(0);?></h1></div><hr/>
					<div class="form-group" style="display:none" id="alat_bayar">
						<label>Pilih Pembayaran :</label>
						<select name="alat_pembayaran" id="alat_pembayaran" class="form-control" onchange="tampil_input_bayar();">
							<option value=""> Pilih Pembayaran </option>
							<option selected value="tunai"> CASH </option>
						</select><br/>
						<div class="input-group margin">
							<input type="text" name="angka_bayar" onkeypress="return Numeric(event);return PressBayar(event);" id="angka_bayar" class="form-control"/>
							<span class="input-group-btn"><a class="btn btn-bni btn-flat" onclick="proses_bayar();" id="btnbayar"><i class="fa fa-money"></i> Bayar</a></span>
						</div>
					</div>
				</div>
			</div><?	
				if($cek_temp->it_toko !=""){?>
					<div class="box" id="konsumen_temp">
						<div class="box-body">
							<div class="form-group">
								<div class="nav-tabs-custom">
									<ul class="nav nav-tabs">
										<li class="active">Transaksi Tertunda</li>
									</ul>									
									<div class="tab-content">
										<div class="tab-pane active">
											<span id="loading_tertunda"></span>
											<span id="list_transaksi_tertunda"></span>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div><?
				}?>
			<div class="modal modal-default fade" id="modal-cari">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title">Pencarian Item</h4>
						</div>
						<div class="modal-body">						
							<div class="input-group margin">
								<input type="text" class="form-control" id="cari_item" name="cari_item" onkeypress="cari_item_beli();" placeholder="Nama Barang / Kode Barcode ..."  class="col-md-3" onkeypress="return PressSearch(event);">
								<span class="input-group-btn"><a class="btn btn-bni btn-flat" onclick="cari_item_beli();" id="btn2Search"><i class="fa fa-search"></i> Cari</a>
								</span>
							</div>
							<table id="daftar_pencarian" class="table table-condensed table-hover table-striped" width="100%"></table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div id="divcontents" style="max-height:400px;display:none;"></div>
	<iframe id="ifmcontentstoprint" style="height: 0px; width: 0px; position: absolute"></iframe>
	
	<script type="text/javascript">
		window.onload= function(){
			view_temp();
		//	tampil_list_belanja();
			$('#kode_item').focus();
		}
		function Numeric(evt) {
		  var charCode = (evt.which) ? evt.which : event.keyCode
		   if (charCode > 31 && (charCode < 48 || charCode > 57))
 
		    return false;
		  return true;
		}

			function myFunction(){
				/* tombol F11 */
				if(event.keyCode == 46) {
					event.preventDefault()
					alert('Anda menekan tombol Delete');
				}
			}
		
		function Press(e){
			// look for window.event in case event isn't passed in
			e = e || window.event;
			if (e.keyCode == 13)
			{	
				document.getElementById('btnSearch').click();
				return false;
				$('#kode_item').val('');
			}
			return true;
		}
		
		function PressSearch(e){
			// look for window.event in case event isn't passed in
			e = e || window.event;
			if (e.keyCode == 13)
			{	
				document.getElementById('btn2Search').click();
				return false;
				$('#cari_item').val('');
			}
			return true;
		}


		function PressBayar(e){
			// look for window.event in case event isn't passed in
			e = e || window.event;
			if (e.keyCode == 13)
			{	
				document.getElementById('btnbayar').click();
				return false;
				$('#angka_bayar').val('');
			}
			return true;
		}
		
		function MasukanKeranjang(e){
			// look for window.event in case event isn't passed in
			e = e || window.event;
			if (e.keyCode == 13)
			{	
				document.getElementById('btnKeranjang').click();
				return false;
				$('#kode_item').val('');
			}
			return true;
		}
				
		function lanjut_belanja(){
			$("#tampil_item").show();
			var id_item 		= $("#kode_item").val();
			$.ajax({
				type: "POST",
				url: "<? echo Yii::app()->createUrl('transaksi/tampil_belanja');?>",
				data: "id_item="+id_item,
				cache: false,
				success:function(html){
					$("#tampil_item").html(html);
					$('#kode_item').val('');
					$('#jml_item2').focus();
				}
			});
		}
				
		function view_temp(){
			$("#loading").html('<img src="<? echo Yii::app()->baseUrl?>/images/loading.gif" width="20" heigt="20"/>');
			var toko	= $("#toko").val();
			
			$.ajax({
				type: "POST",
				url: "<? echo Yii::app()->createUrl('transaksi/viewtemp');?>",
				data: "toko="+toko,
				cache: false,
				success:function(html){
					totalbayar(toko);
					//tampil_list_belanja();
					$("#daftar_transaksi").html(html);
					$("#loading").html('');
				//	$("#konsumen_temp").show();
				//	$('#kode_item').focus();
				}
			});
		}
		
		function tampil_list_belanja(){
			$("#loading_tertunda").html('<img src="<? echo Yii::app()->baseUrl?>/images/loading.gif" width="20" heigt="20"/>');
			$.ajax({
				type: "POST",
				url: "<? echo Yii::app()->createUrl('transaksi/tampil_list_belanja');?>",
				data: "konsumen=1",
				cache: false,
				success:function(html){
					$("#list_transaksi_tertunda").html(html);
					
					$("#loading_tertunda").html('');
				}
			});
		}
		
		function remove_bayar(id){
			
			if(!confirm('Apakah anda akan membatalkan transaksi ini ?')){
			  return false;
			}
			$("#loading").html('<img src="<? echo Yii::app()->baseUrl?>/images/loading.gif" width="20" heigt="20"/>');
			$.ajax({
				type: "POST",
				url: "<? echo Yii::app()->createUrl('transaksi/remove_bayar');?>",
				data: "urutan_konsumen="+id,
				cache: false,
				success:function(html){
					totalbayar(id);
					view_temp();
					$("#loading").html('');
				}
			});
		}
		
		function belanja_temp(){
			var id_item 		= $("#kd_item").val();
			var jml_item		= $("#jml_item2").val();
			var toko			= $("#toko").val();
			var data 			= "kode_item="+id_item+"&toko="+toko+"&jml_item="+jml_item;
			
			$.ajax({
				type: "POST",
				url: "<? echo Yii::app()->createUrl('transaksi/transaksi_temp');?>",
				data: data,
				cache: false,
				success:function(html){
					view_temp();
					$("#kode_item").val('');
					$("#tampil_item").hide();
					$('#kode_item').focus();			
				}
			});
		}			
		
		function edit_jml(id){
			
			$.ajax({
				type: "POST",
				url: "<? echo Yii::app()->createUrl('transaksi/edit_jumlah_beli');?>",
				data: "id="+id,
				cache: false,
				success:function(html){
					$("#form_edit_"+id).html(html);
				}
			});
		}	
		
		function hapus_temp(id){
			var jml_beli 	= $("#temp_jml_beli"+id).val();
			var nama_brg 	= $("#nama_brg_"+id).val();
			var kode 	 	= $("#kode_brg_"+id).val();
			if (confirm('Batalkan untuk barang '+ nama_brg +'?')) {
			$.ajax({
				type: "POST",
				url: "<? echo Yii::app()->createUrl('transaksi/hapus_temp');?>",
				data: "id="+id+"&jml="+jml_beli+"&kode="+kode,
				cache: false,
				success:function(html){
					
					view_temp();	
				}
			});
			}else {
				return false;
			}
		}	
		
		function update(id){
			var jml 		= $("#jumlah").val();
			var jml_a 		= $("#jumlah_awal").val();
			var jml_edit	= parseInt($('#jumlah').val());
			if(jml_edit > 0) {
				$.ajax({
					type: "POST",
					url: "<? echo Yii::app()->createUrl('transaksi/update_jumlah_beli');?>",
					data: "id="+id+"&jml="+jml+"&jml_a="+jml_a,
					cache: false,
					success:function(html){
						view_temp();
					}
				});
			}else{
				alert('pembelian minimal 1');
				return false;
			}
		}	
		
		function totalbayar(id){
			
			$.ajax({
				type: "POST",
				url: "<? echo Yii::app()->createUrl('transaksi/total_bayar');?>",
				data: "toko="+id,
				cache: false,
				success:function(html){
					$("#total_bayar").html(html);
					$("#alat_bayar").show();
				}
			});
		}	
		
		function cari_item_beli(){
			var cari_item 	= $("#cari_item").val();
			$.ajax({
				type: "POST",
				url: "<? echo Yii::app()->createUrl('transaksi/cari_item_beli');?>",
				data: "cari_item="+cari_item,
				cache: false,
				success:function(html){
					$("#daftar_pencarian").html(html);
				}
			});
		}	
		
		function pilih_item(id){
			var toko	= $("#toko").val();
			var kode 	= $("#kode_barang_"+id).val();
			var data 	= "kode_item="+kode+"&toko="+toko+"&jml_item=1&id="+id;
			
			$.ajax({
				type: "POST",
				url: "<? echo Yii::app()->createUrl('transaksi/transaksi_temp');?>",
				data: data,
				cache: false,
				success:function(html){
					
					$("#cari_item").val('');
					$("#daftar_pencarian").html('');
					view_temp();
					
				}
			});
		}	
		
		function tampil_input_bayar(){
			$('#angka_bayar').focus();
		}	
			
		function proses_bayar(){

			$('#btnbayar').attr("disabled", true);
			var jmlbayar    	= parseInt($('#angka_bayar').val());
			var nomnalbayar 	= parseInt($('#wajib_bayar').val());
			var urutan_konsumen	= $("#toko").val();
			var alat_pembayaran = $('#alat_pembayaran').val();	
			var data_cash 		= "jmlbayar="+jmlbayar+"&nomnalbayar="+nomnalbayar+"&toko="+urutan_konsumen;
			var data_tcash 		= "no_tcash="+jmlbayar+"&nominal_beli="+nomnalbayar+"&toko="+urutan_konsumen;
			
			if(jmlbayar>=nomnalbayar){
				
				$.ajax({
					type: "POST",
					url: "<? echo Yii::app()->createUrl('transaksi/proses_bayar');?>",
					data: data_cash,
					cache: false,
					success:function(html){
						view_temp();
						$("#divcontents").html(html);
						
						var content = document.getElementById("divcontents");
						var pri = document.getElementById("ifmcontentstoprint").contentWindow;
									
						pri.document.open();
						pri.document.write(content.innerHTML);
						pri.document.close();
						pri.focus();
						pri.print();
						
						$('#angka_bayar').val('');
						$('#btnbayar').attr("disabled", false);
					}
				});
			}else{
				alert('Pembayaran Kurang.');
				$('#btnbayar').attr("disabled", false);
			}
		}	
		
			
		</script>