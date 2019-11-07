<?  	$bulan_now 	= date('m');
		$bulan_lalu = $bulan_now - 5;	
		
		if($bulan_lalu > 6){
			$tahun_lalu 	= date('Y')-1;
		}else{
			$tahun_lalu 	= date('Y');
		}

?>
<section class="content-header"><h1> Dashboard </h1></section>
<section class="content">
	<div class="row"  style="width:1110px;">
		<div class="col-md-3 col-sm-6 col-xs-12">
			<div class="info-box">
				<span class="info-box-icon bg-red"><i class="fa fa-money"></i></span>
				<div class="info-box-content">
					<span class="info-box-text">OMSET</span>
					<span class="info-box-number"><? echo $this->Uang($omset);?></span>
				</div>
			</div>
		</div>
		<div class="col-md-3 col-sm-6 col-xs-12">
			<div class="info-box">
				<span class="info-box-icon bg-green"><i class="ion ion-ios-people-outline"></i></span>
				<div class="info-box-content">
					<span class="info-box-text">LABA</span>
					<span class="info-box-number"><? echo $this->Uang($t_cash);?></span>
				</div>
			</div>
		</div><div class="clearfix visible-sm-block"></div>
		<div class="col-md-3 col-sm-6 col-xs-12">
			<div class="info-box">
				<span class="info-box-icon bg-aqua"><i class="ion ion-ios-cart-outline"></i></span>
				<div class="info-box-content">
					<span class="info-box-text">ITEM</span>
					<span class="info-box-number"><? echo $this->Uang($jml_item);?></span>
				</div>
			</div>
		</div>
		<div class="col-md-3 col-sm-6 col-xs-12">
			<div class="info-box">
				<span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>
				<div class="info-box-content">
					<span class="info-box-text">CASH</span>
					<span class="info-box-number"><? echo $this->Uang($cash);?></span>
				</div>
			</div>
		</div>
	</div>
	<div class="row" style="width:1110px;">
		<div class="col-md-12">
			<div class="box">
			<div class="box-header with-border">
				<h3 class="box-title"><strong>LAPORAN PENJUALAN PERIODE 6 BULAN TERAKHIR</strong></h3>
				<div class="box-tools pull-right">
					<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i> </button>
					<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
				</div>
			</div>
			<div class="box-body">
				<div class="row">
					<div class="col-md-8">
						<p class="text-center"></p>
						<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/chart/Chart.bundle.js"></script>
						<div class="chart">
							<canvas id="myChart" height="80"></canvas>
						</div>
						<script>
							var ctx = document.getElementById("myChart");
							var myChart = new Chart(ctx, {
								type: 'line',
								data: {
									labels: [ 
												<?  for ($i=$bulan_lalu; $i <= $bulan_now; $i++) {
														if($i<1){
															$bulan 	= $i+12;
														}else{
															$bulan 	= $i;
														}
														echo '"' .$this->GetNamaBulan($bulan). '",'; 
													} ?>
											],
									datasets: [	
												{
													label: '# LABA',
													data: 	[
																<?  for ($i=$bulan_lalu; $i <= $bulan_now; $i++) {
																		if($i<1){
																			$bulan 	= $i+12;
																		}else{
																			$bulan 	= $i;
																		}
																	//	echo '"' .$this->GetLabaBulan($bulan). '",'; 
																	} ?>
															],
													backgroundColor: [
														'#006674'
													],
													borderColor: [
														'#006674'
													],
													borderWidth: 1
												},
												{
													label: '# OMSET',
													data: 	[
																<?  for ($i=$bulan_lalu; $i <= $bulan_now; $i++) {
																		if($i<1){
																			$bulan 	= $i+12;
																		}else{
																			$bulan 	= $i;
																		}
																	//	echo '"' .$this->GetOmsetBulan($bulan). '",'; 
																	} ?>
															],
													backgroundColor: [
														'#beebf3'
													],
													borderColor: [
														'#beebf3',
													],
													borderWidth: 1
												}
										]
								},
								options: {
									scales: {
										yAxes: [{
												ticks: {
													beginAtZero: true
												}
											}]
									}
								}
							});
						</script>
					</div>
					<div class="col-md-4">
						<p class="text-center"><strong>ITEM TERLARIS</strong></p>
						<? $urut 	= 1;?>
						<? foreach($ItemLaris as $laris){?>
						<?	if($urut==1){
								$class='class="progress-bar progress-bar-green"';
							}
							if($urut==2){
								$class='class="progress-bar progress-bar-aqua"';
							}
							if($urut==3){
								$class='class="progress-bar progress-bar-yellow"';
							}
							if($urut==4){
								$class='class="progress-bar progress-bar-red"';
							}?>
							<?	$terjual 		= $laris->iJumlah;
								$total_stok 	= $terjual 	+ $this->GetStokItem($laris->iKodeBr);

								if($terjual>0){
									$persen 		= ($terjual/$total_stok)*100;
								}else{
									$persen 		= 0;
								}
							 	
							
							?>
						<div class="progress-group">
							<span class="progress-text"><? echo $this->GetNamaItem($laris->iKodeBr);?></span>
							<span class="progress-number"><b><? echo $terjual; ?></b>/<? echo $total_stok; ?></span>
							<div class="progress lg">
								<div <? echo $class;?> style="width: <? echo $persen;?>%;height:40px"> <? echo round($persen,1);?>%</div>
							</div>
						</div>
						<? $urut++;?>
						<?}?>
					</div>
				</div>
			</div>
				<div class="box-footer">
					<div class="row">
						<div class="col-sm-3 col-xs-6">
							<div class="description-block border-right">
								<span style="color:#006677;"><i <? echo $class_omset; ?>></i> <? echo $persen_omset;?>%</span>
									<h5 class="description-header"><? echo $this->Uang($omset_year);?></h5>
								<span class="description-text">TOTAL OMSET </span>
							</div>
						</div>
						<div class="col-sm-3 col-xs-6">
							<div class="description-block border-right">
								<span style="color:#006677;"><i <? echo $class_tcash; ?>></i> <? echo $persen_tcash;?>%</span>
									<h5 class="description-header"><? echo $this->Uang($tcash_year);?></h5>
								<span class="description-text">TOTAL T-CASH</span>
							</div>
						</div>
						<div class="col-sm-3 col-xs-6">
							<div class="description-block border-right">
								<span style="color:#006677;"><i <? echo $class_item; ?>></i> <? echo $persen_item;?>%</span>
									<h5 class="description-header"><? echo $this->Uang($jmlitem_year);?></h5>
								<span class="description-text">TOTAL ITEM</span>
							</div>
						</div>
						<div class="col-sm-3 col-xs-6">
							<div class="description-block">
								<span style="color:#006677;"><i <? echo $class_cash; ?>></i> <? echo $persen_cash;?>%</span>
									<h5 class="description-header"><? echo $this->Uang($cash_year);?></h5>
								<span class="description-text">TOTAL CASH</span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-8">
			<div class="box box-info">
				<div class="box-header with-border">
				<h3 class="box-title"><strong>LIMIT STOK ITEM</strong></h3>

				<div class="box-tools pull-right">
				<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
				</button>
				<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
				</div>
				</div>
				<div class="box-body">
					<div class="table-responsive">
					<table class="table no-margin">
						<thead>
							<tr>
								<th>ID</th>
								<th>Item</th>
								<th>Jumlah Terjual</th>
								<th>Sisa Stok</th>
							</tr>
						</thead>
						<tbody>
							<?/* foreach($LimitItem as $data){
									$cr_jual 			= new CDbCriteria;
									$cr_jual->select	= "sum(pos_transaksi_detail_jumlah) as pos_transaksi_detail_jumlah";
									$cr_jual->condition	= "	pos_transaksi_detail_item_id='".$data->pos_item_id."' 
															and pos_transaksi_detail_sekolah_id='".$sekolah_id."'";
									$ItemTerjual		= PosTransaksiDetail::model()->find($cr_jual);
									$totalterjual		= $ItemTerjual->pos_transaksi_detail_jumlah;
									if($totalterjual > 0){
							?>
							<tr>
								<td><code><? echo $data->pos_item_id; ?></code></td>
								<td><? echo $data->pos_item_nama; ?></td>
								<td><? echo $totalterjual; ?></td>
								<td><div class="sparkbar" data-color="#00a65a" data-height="20"><? echo $data->pos_item_stok; ?></div></td>
							</tr>
							<?}}*/?>
						</tbody>
					</table>
					</div>
				</div>
				<div class="box-footer clearfix">
					<a href="javascript:void(0)"  data-toggle="modal" data-target="#modal-stok" onclick="tampil_stoklimit(<? echo $sekolah_id;?>);" class="btn btn-sm btn-bni btn-flat pull-right" style="color:white">Tampil Lebih Banyak</a>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="info-box bg-yellow">
				<span class="info-box-icon"><i class="ion ion-ios-pricetag-outline"></i></span>

				<div class="info-box-content">
					<span class="info-box-text">OMSET</span>
					<span class="info-box-number"><? echo $this->Uang($omset_month); ?></span>

					<div class="progress">
					<div class="progress-bar" style="width: 100%"></div>
					</div>
					<span class="progress-description">
					Omset  bulan <? echo $this->GetNamaBulan(date('m'));?>
					</span>
				</div>
			</div>
			<div class="info-box bg-green">
				<span class="info-box-icon"><i class="ion ion-ios-heart-outline"></i></span>

				<div class="info-box-content">
					<span class="info-box-text">T-CASH</span>
					<span class="info-box-number"><? echo $this->Uang($tcash_month); ?></span>

					<div class="progress">
					<div class="progress-bar" style="width: 100%"></div>
					</div>
					<span class="progress-description">
					Transaksi T-Cash bulan <? echo $this->GetNamaBulan(date('m'));?>
					</span>
				</div>
			</div>
			<div class="info-box bg-red">
				<span class="info-box-icon"><i class="ion ion-ios-cloud-download-outline"></i></span>

				<div class="info-box-content">
					<span class="info-box-text">ITEM</span>
					<span class="info-box-number"><? echo $jmlitem_month;?></span>

					<div class="progress">
					<div class="progress-bar" style="width: 100%"></div>
					</div>
					<span class="progress-description">
					Item Terjual bulan <? echo $this->GetNamaBulan(date('m'));?>
					</span>
				</div>
			</div>
			<div class="info-box bg-aqua">
				<span class="info-box-icon"><i class="ion-ios-chatbubble-outline"></i></span>
				<div class="info-box-content">
					<span class="info-box-text">CASH</span>
					<span class="info-box-number"><? echo $this->Uang($cash_month); ?></span>

					<div class="progress">
					<div class="progress-bar" style="width: 100%"></div>
					</div>
					<span class="progress-description">
					Transaksi Cash bulan <? echo $this->GetNamaBulan(date('m'));?>
					</span>
				</div>
			</div>
		</div>
	</div>
</section>
<div class="modal modal-default fade" id="modal-stok">
  <div class="modal-dialog">
	<div class="modal-content">
	  <div class="modal-header" >
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		  <span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title">Daftar Stok Item</h4>
	  </div>
	  <div class="modal-body" id="limit_stok"></div>
	</div>
	<!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>


	<script type="text/javascript">  
		function tampil_stoklimit(id_sekolah){
			$.ajax({
				type: "POST",
				url: "<? echo Yii::app()->createUrl('home/tampil_limit_item');?>",
				data: "id_sekolah="+id_sekolah,
				cache: false,
				success: function(html){
					$("#limit_stok").html(html);
				} 
			});
		}		
	</script>
