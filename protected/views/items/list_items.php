<section class="content">
<div class="row"  style="min-height:850px;width:1110px">
	<div class="col-xs-12">
		<div class="box box-default">
			<div class="box-header with-border">
				<h3 class="box-title"><i class="fa fa-search"></i> Pencarian</h3>
				<div class="box-tools pull-right">
					<a href="#" data-toggle="modal" onclick="loadManualBook(2)" data-target="#myModalBantuan" class="pull-right" title="Klik Bantuan">
					<i class="fa fa-question-circle fa-2x"></i></a>
					<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>&nbsp;&nbsp;&nbsp;&nbsp;
				</div>
			</div>
			<div class="box-body">
				<div class="row">
					<table width="100%" style="margin-left:10px">
						<tr><td>Supplier</td><td>Toko</td><td>Kategori</td><td>Jenis</td><td colspan="3"></td></tr>
						<tr>
							<td>
								<select class="form-control" name="supplier" id="supplier" style="width:140px" onchange="list_item();">
									<? foreach($modsupplier as $supplier){?>
										<option value="<?=$supplier->no_id; ?>"><?=$supplier->perusahaan; ?></option>
									<?}?>
								</select>
							</td>
							<td>
								<? if($kode_toko=='00'){?>
									<select class="form-control" name="toko" id="toko" onchange="list_item();">
										<option value=""> Semua Toko </option>
										<? foreach($modtoko as $toko){?>
											<option value="<? echo $toko->no_id; ?>"><? echo $toko->toko; ?></option>
										<?}?>
									</select>
								<?}else{?>
									<input type="hidden" name="toko" id="toko" vaue="<?=$this->GetSekolahId();?>">
									<input type="text" name="nama_toko" id="nama_toko" vaue="<?=$kode_toko;?> <?=$this->GetNamaToko($kode_toko);?>">
								<?}?>
							</td>
							<td>
								<select class="form-control" name="nama_kategori" id="nama_kategori" onchange="list_item();">
									<option value="">Semua Kategori</option>
									<? foreach($modkategori as $data){?>
											<option value="<? echo $data->nama_katagori; ?>"><? echo $data->nama_katagori; ?></option>
									<?}?>
								</select>
							</td>
							<td>
								<select class="form-control" name="nama_jenis" id="nama_jenis" onchange="list_item();">
									<option value="">Semua Jenis</option>
									<? foreach($modjenis as $jenis){?>
										<option value="<? echo $jenis->nama_jenis; ?>"><? echo $jenis->nama_jenis; ?></option>
									<?}?>
								</select>
							</td>
							<td>
								<input type="text" onkeypress="list_item();" style="width:130px" class="form-control" name="nama_item" id="nama_item" placeholder="Nama Barang" onkeyPress="list_item();">
							</td>
							<td>
								<a class="btn btn-bni" onclick="list_item();" title="Klik Untuk Cari Barang"><i class="fa fa-search"></i> </a>
							</td>
							<td><div class="btn-group">
								<a class="btn btn-bni"  data-toggle="modal" data-target="#modal-item" onclick="tampil_tgl();"><i class="fa fa-plus"></i> Barang</a>
								<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"><i class="fa fa-list"></i> <span class="caret"></span><span class="sr-only">Toggle Dropdown</span></button>
								<ul class="dropdown-menu" role="menu">							
									<li><a href="<? echo Yii::app()->createUrl('items/form_import');?>">Import Item</a></li>
									<li><a href="<? echo Yii::app()->createUrl('items/form_eksport');?>">Ekspor Item</a></li>
									<li class="divider"></li>
									<li><a data-toggle="modal" data-target="#modal-jenis" style="cursor:pointer">Tambah Jenis</a></li>
									<li><a data-toggle="modal" data-target="#modal-kategori" style="cursor:pointer">Tambah Kategori</a></li>
								</ul></div>
							</td>
						</tr>
					</table>
					<div class="col-md-2">
						<div class="form-group"  class="col-md-2">
							<label>&nbsp;</label><br/>
			
							<div class="modal modal-default fade" id="modal-item">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span></button>
											<h4 class="modal-title">Tambah Barang</h4>
										</div>
										<div class="modal-body">
											<table width="100%">
												<tr>
													<td>Barcode</td>
													<td><input type="text" class="form-control" id="add_barcode" name="add_barcode" placeholder="Kode Barcode ..."  class="col-md-3"></td>
													<td>&nbsp;</td>
													<td>Nama</td>
													<td>
														<input type="text" class="form-control" id="add_item" name="add_item" placeholder="Nama Item ..."  class="col-md-3">
													</td>
												</tr>
												<tr>													
													<td>Kategori</td>
													<td>&nbsp;
													<select class="form-control" id="add_kategori" name="add_kategori" class="col-md-3">
														<option value="">Pilih Kategori</option>
															<? foreach($modkategori as $data_item){?>
														<option value="<? echo $data_item->nama_katagori; ?>"><? echo $data_item->nama_katagori; ?></option>
														<?}?>
													</select>
													</td>
													<td>&nbsp;</td>
													<td>Jenis</td>
													<td>&nbsp;
													<select class="form-control" id="tambah_jenis" name="tambah_jenis" class="col-md-3">
														<option value="">Pilih Jenis</option>
															<? $modjenis 	= Jenis::model()->findAll();?>
															<? foreach($modjenis as $modjenis){?>
																<option value="<? echo $modjenis->nama_jenis; ?>"><? echo $modjenis->nama_jenis; ?></option>
															<?}?>
													</select>
													</td>
												</tr>
												<tr>
													<td>Beli (@)</td>
													<td>&nbsp;
													<input type="text" class="form-control" id="add_harga_beli"  onkeypress="return Numeric(event)" name="add_harga_beli" placeholder="Harga Beli ..."  class="col-md-3">
													</td>
													<td>&nbsp;</td>
													<td>Jual (@)</td>
													<td>&nbsp;
														<input type="text" class="form-control" id="add_harga_jual"  onkeypress="return Numeric(event)" name="add_harga_jual" placeholder="Harga Jual ..."  class="col-md-3">
													</td>
												</tr>
												<tr><td>Jumlah</td>
													<td>&nbsp;<input type="text" class="form-control" onkeypress="return Numeric(event)" id="add_jml_item" name="add_jml_item" placeholder="Jumlah Item ..."  class="col-md-3"></td>
													<td>&nbsp;</td>
													<td>Expaired</td>
													<td>&nbsp;
														<input type="date" class="form-control" id="expaired" name="expaired" class="col-md-3">
													</td>
												</tr>
											</table>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn pull-left  btn-bni" data-dismiss="modal">Batal</button>
											<a onclick="simpan_item();" data-dismiss="modal" class="btn btn-bni">Simpan </a>
										</div>
									</div>
								</div>
							</div>
							<div class="modal modal-default fade" id="modal-kategori">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span></button>
											<h4 class="modal-title">Tambah Kategori</h4>
										</div>
										<div class="modal-body">						
											<label>Nama Kategori</label>
											<input type="text" class="form-control" id="new_kategori" name="new_kategori" placeholder="Nama Kategori ..."  class="col-md-3">
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-bni pull-left" data-dismiss="modal">Batal</button>
											<a onclick="simpan_kategori();" data-dismiss="modal" class="btn btn-bni">Simpan </a>
										</div>
									</div>
								</div>
							</div>
							<div class="modal modal-default fade" id="modal-jenis">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span></button>
											<h4 class="modal-title">Tambah Jenis</h4>
										</div>
										<div class="modal-body">						
											<label>Nama Jenis</label>
											<input type="text" class="form-control" id="new_jenis" name="new_jenis" placeholder="Nama Jenis ..."  class="col-md-3">
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-bni pull-left" data-dismiss="modal">Batal</button>
											<a onclick="simpan_jenis();" data-dismiss="modal" class="btn btn-bni">Simpan </a>
										</div>
									</div>
								</div>
							</div>
							<div class="modal modal-default fade" id="modal_edit">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span></button>
											<h4 class="modal-title">Edit Item <span id="loading_edit"></span></h4>
										</div>
										<div class="modal-body"  id="bodyedit"> </div>
											<div class="modal-footer">
												<button type="button" class="btn btn-bni pull-left" data-dismiss="modal">Batal</button>
												<a onclick="update_item();" data-dismiss="modal" class="btn btn-bni">Simpan </a>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
	</div><span id="loading_update"></span><span id="loading"> </span>
	<div class="col-xs-12" id="daftar_items"></div>
</div>
</section>

<script type="text/javascript">  
	window.onload= function(){
			list_item();
	}

	function Numeric(evt) {
			var charCode = (evt.which) ? evt.which : event.keyCode
			if (charCode > 31 && (charCode < 48 || charCode > 57))
			return false;
			return true;
	}

	function list_item(page,limit){

			$("#loading").html('<img src="<? echo Yii::app()->baseUrl?>/images/loading.gif" width="20" heigt="20"/> sedang memuat data...');
			var toko 		= $("#supplier").val();
			var nama_item 	= $("#nama_item").val();
			var kategori 	= $("#nama_kategori").val();
			var jenis 	 	= $("#nama_jenis").val();
			var data 		=  "kategori="+kategori+"&jenis="+jenis+"&nama_item="+nama_item+'&page='+page+'&limit='+limit+"&toko="+toko;
			
			$.ajax({
				type: "POST",
				url: "<? echo Yii::app()->CreateUrl('items/viewitems');?>",
				data: data,
				cache: false,
				success: function(html){
						$("#daftar_items").html(html);
						$("#loading").html('');
				},
				error:function(html){
					alert(html);
					$("#loading").html('');
				} 
			});
	}	

		function simpan_item(){
				var barcode 		= $("#add_barcode").val();
				var kategori 		= $("#add_kategori").val();
				var jenis 			= $("#tambah_jenis").val();
				var item 			= $("#add_item").val();
				var jml_item 		= $("#add_jml_item").val();
				var beli 			= $("#add_harga_beli").val();
				var jual 			= $("#add_harga_jual").val();
				var supplier		= $("#supplier").val();
				var expaired 		= $("#expaired").val();
				var dataString 	= "barcode="+barcode+"&expaired="+expaired+"&supplier="+supplier+"&kategori="+kategori+"&jenis="+jenis+"&item="+item+"&jml="+jml_item+"&beli="+beli+"&jual="+jual;
				
				$.ajax({
						type: "POST",
						url: "<? echo Yii::app()->createUrl('items/simpanitems');?>",
						data: dataString,
						cache: false,
						success: function(html){
								list_item();
								alert(html);
						},
						error:function(html){
							alert('gagal simpan');
							$("#loading").html('');
						}  
				});
		}

		function update_item(){
				var barcode 		= $("#update_barcode").val();
				var kategori 		= $("#update_kategori").val();
				var jenis 	 		= $("#update_jenis").val();
				var item 			= $("#update_item").val();
				var jml_item 		= $("#update_jml_item").val();
				var beli 			= $("#update_harga_beli").val();
				var jual 			= $("#update_harga_jual").val();
				var lokasi			= $("#update_lokasi").val();

				var dataString 	= "barcode="+barcode+"&jenis="+jenis+"&kategori="+kategori+"&item="+item+"&jml="+jml_item+"&beli="+beli+"&jual="+jual+"&lokasi="+lokasi;
				$("#loading_update").html('<img src="<? echo Yii::app()->baseUrl?>/images/loading.gif" width="20" heigt="20"/> sedang mengupdate data...');
				$.ajax({
						type: "POST",
						url: "<? echo Yii::app()->createUrl('items/updateitems');?>",
						data: dataString,
						cache: false,
						success: function(html){
								$("#loading_update").html('');
								$("#update_barcode").val('');
								$("#update_item").val('');
								$("#update_jml_item").val('');
								$("#update_harga_beli").val('');
								$("#update_harga_jual").val('');
								list_item();
						} 
				});
		}

		function simpan_kategori(){
				var kategori 	= $("#new_kategori").val();
				$("#loading").html('<img src="<? echo Yii::app()->baseUrl?>/images/loading.gif" width="20" heigt="20"/>');
				$.ajax({
						type: "POST",
						url: "<? echo Yii::app()->createUrl('kategori/add_kategori');?>",
						data: "kategori="+kategori,
						cache: false,
						success: function(html){
								window.location.reload();
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
						url: "<? echo Yii::app()->createUrl('items/delete_item');?>",
						data: "id="+id_item,
						cache: false,
						success: function(html){
								list_item();
								$("#loading_delete_"+id).html('');
						} 
				});
		}		

		function edit_item(id){
		var iditem 	= $("#id_item_"+id).val();
		var lokasi 	= $("#toko").val();
		$("#loading_edit").html('<img src="<? echo Yii::app()->baseUrl?>/images/loading.gif" width="20" heigt="20"/>');
		$.ajax({
				type: "POST",
				url: "<? echo Yii::app()->createUrl('items/edit_item');?>",
				data: "id="+iditem+"&lokasi="+lokasi,
				cache: false,
				success: function(html){
						$("#bodyedit").html(html);
						$("#loading_edit").html('');
				} 
		});
		}		
</script>
