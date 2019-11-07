
<section class="content">
	<div class="row"  style="min-height:850px">
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

					<div class="input-group date">
						<div class="input-group-addon">
							<i class="fa fa-calendar"></i>
						</div>						
						  <!-- Include Required Prerequisites -->
						<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-min.js"></script>
						<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/moment-min.js"></script>
						 
						<!-- Include Date Range Picker -->
						<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/daterangepicker.js"></script>
						</head>
						<body>					 
						<input type="text" class="form-control" name="datefilter" id="datefilter" value="" />
 
							<script type="text/javascript">
							$(function() {

							  $('input[name="datefilter"]').daterangepicker({
								  autoUpdateInput: false,
								  locale: {
									  cancelLabel: 'Clear'
								  }
							  });

							  $('input[name="datefilter"]').on('apply.daterangepicker', function(ev, picker) {
								  $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
							  });

							  $('input[name="datefilter"]').on('cancel.daterangepicker', function(ev, picker) {
								  $(this).val('');
							  });

							});
							</script>
						 
						 
						</body>
					</div>
					<!-- /.input group -->
				</div>
            </div>
			<div class="col-md-3">
				<div class="form-group"  class="col-md-3">
					 
					  <label>&nbsp;</label><br/>
					  <a class="btn btn-bni" onclick="tampil_laporan_laba();"><i class="fa fa-search"></i> Cari</a>
					  <span id="link_laporan_laba"></span>
				</div>
              <!-- /.form-group -->
            </div>
          </div>
          <!-- /.row -->
        </div>
      </div>
      </div>
		<span id="loading_laba"> </span>
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title"><i id="loading"></i> <b>Laporan Laba</b></h3>
				</div>
				<div class="box-body">
					<table id="daftar_laporan_laba" class="table table-bordered table-hover table-condensed" ></table>
				</div>
			</div>
		</div>
      </div>
</section>

<script type="text/javascript">  
	function tampil_laporan_laba(){
		var date 		= $("#datefilter").val();
		var dataString 	= "date="+date;
		
		$("#loading_laba").html('<img src="<? echo Yii::app()->baseUrl?>/images/loading.gif" width="20" heigt="20"/>');
		$.ajax({
			type: "POST",
			url: "<? echo Yii::app()->createUrl('laporan/laporan_laba');?>",
			data: dataString,
			cache: false,
			success: function(html){
				
				link_download();
				$("#daftar_laporan_laba").html(html);
				$("#loading_laba").html('');
			} 
		});
	}	
	
	function link_download(){
		var date 		= $("#datefilter").val();
		var dataString 	= "date="+date;
		
		$.ajax({
			type: "POST",
			url: "<? echo Yii::app()->createUrl('laporan/link_laporan_laba');?>",
			data: dataString,
			cache: false,
			success: function(html){
				$("#link_laporan_laba").html(html);
			} 
		});
	}		
	</script>
	<?/*
	
// Designate string to be encrypted : Teks yang akan di Enkripsi
$string = "Kartika Imam Santoso, STMIK BINA PATRIA";

// Encryption/decryption key : Kunci
$key = "Jalan-jalan malam Minggu";

// Encryption Algorithm
$cipher_alg = MCRYPT_RIJNDAEL_128;

// Create the initialization vector for added security.
$iv = mcrypt_create_iv(mcrypt_get_iv_size($cipher_alg,
MCRYPT_MODE_ECB), MCRYPT_RAND);

// Output original string
echo "Plain Text : $string <p>";

// Encrypt $string
$encrypted_string = mcrypt_encrypt($cipher_alg, $key,
$string, MCRYPT_MODE_CBC, $iv);

// Convert to hexadecimal and output to browser
echo "Encrypted string: ".bin2hex($encrypted_string)."<p>";

$decrypted_string = mcrypt_decrypt($cipher_alg, $key,
$encrypted_string, MCRYPT_MODE_CBC, $iv);

echo "Decrypted string: $decrypted_string";*/?>