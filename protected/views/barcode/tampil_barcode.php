<!--link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js"></script-->
<script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/jquery-latest.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/assets/jquery-barcode.js"></script>


<style>
{
color: #7F7F7F;
font-family: Arial, sans-serif;
font-size: 12px;
font-weight: normal;
}
#submit {
clear: both;
}
#barcodeTarget,  #canvasTarget {
margin-top: 20px;
}
</style>

<form id="barcode" action="<?=Yii::app()->CreateUrl('barcode/cetak_barcode');?>" method="POST">

<section class="content">
	<div class="row"  style="width:1110px">
	   	<div class="col-xs-12">
	  		<div class="box box-default">
				<div class="box-header with-border">
					
				</div>
				<div class="box-body">
					<div class="row">
						<div class="col-md-4"></div>								
						<div class="col-md-4"  id="barcodeTarget">
						<?		$optionsArray = array(
								'elementId'=> 'showBarcode','value'=> $kode_barang,'type'=>'ean8','settings'=>array(
									'barWidth' => 2,
									'barHeight' => 100,
									'fontSize' => 18,
								),);
									$this->widget('application.exstensions.barcode.Barcode', $optionsArray);
						
						?>
						
						</div>									
						<div class="col-md-4"><input type="text" id="kode" name="kode" value="<?=$kode_barang?>" class="form-control" /></div>									
					</div>
					<div class="row">
						<div class="col-md-4"></div>								
						<div class="col-md-2">
							<input style="text-align:center;" maxlength="2" onkeypress=" return Numeric(event);" type="text" class="form-control" id="total" name="total">
						</div>									
						<div class="col-md-6">
							<button target="_blank" class="btn btn-info btn-flat" type="submit"><i class="fa fa-print"></i> Cetak</button>				
						</div>									
					</div>
				</div>
			</div>
      	</div>
    </div>
</section>
</form>
<input type="hidden" name="barcodeValue" id="barcodeValue" value="<?=$kode_barang?>">
<input type="hidden" name="type_ean" id="type_ean" value="ean8">
<input type="hidden" name="type_img" id="type_img" value="bmp">
<input type="hidden" id="bgColor" value="#FFFFFF" size="7">
<input type="hidden" id="color" value="#000000" size="7">
<input type="hidden" id="barWidth" value="2" size="3">
<input type="hidden" id="barHeight" value="100" size="3">
<input type="hidden" id="moduleSize" value="5" size="3">
<input type="hidden" id="quietZoneSize" value="1" size="3">
<input type="hidden" id="posX" value="10" size="3">
<input type="hidden" id="posY" value="20" size="3">
<script type="text/javascript">
	function Numeric(evt) {
		var charCode = (evt.which) ? evt.which : event.keyCode
		if (charCode > 31 && (charCode < 48 || charCode > 57))

			return false;
		return true;
	}

	$(function(){
	  $('#type_img').click(function(){
		if ($(this).attr('id') == 'canvas') $('#miscCanvas').show(); else $('#miscCanvas').hide();
	  });
	  generateBarcode();
	});
    
	function generateBarcode(){
	  var value = $("#barcodeValue").val();
	  var btype = $("#type_ean").val();
	  var renderer = $("#type_img").val();
	
	  var quietZone = false;
	  var settings = {
		output:renderer,
		bgColor: $("#bgColor").val(),
		color: $("#color").val(),
		barWidth: $("#barWidth").val(),
		barHeight: $("#barHeight").val(),
		moduleSize: $("#moduleSize").val(),
		posX: $("#posX").val(),
		posY: $("#posY").val(),
		addQuietZone: $("#quietZoneSize").val()
	  };
	
		$("#barcodeTarget").html("").show().barcode(value, btype, settings);
	}
	
</script>