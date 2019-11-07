<? 
$optionsArray = array(
	'elementId'=> 'barcodeTarget','value'=>$kode_barang,'type'=>'ean8','settings'=>array(
		'barWidth' => 2,
		'barHeight' => 100,
		'fontSize' => 18,
	),);
$this->widget('application.exstensions.barcode.Barcode', $optionsArray);

$html.='
						<table class="table table bordered table condensed table-hover">';
							$row 		= round($total/6,0); 
							$selisih 	= $total -($row*6);

							if($selisih>0){
								$jumlah_baris 	= $row +1;
							}else{
								$jumlah_baris 	= $row;
							}
							
							for($x=1;$x<=$jumlah_baris;$x++){
								if($x==$jumlah_baris){
									if($selisih==0){
										$looping_kolom 	= 6;
									}elseif($selisih<0){
										$looping_kolom 	= 6 + $selisih;
									}else{
										$looping_kolom 	= $selisih;
									}
								}else{
									$looping_kolom  = 6;
								}		
	$html.='						
							<tr style="width:25px">';
								 for($i=1;$i<=$looping_kolom;$i++){
									$html.='														
								<td style="text-align:center;width:25px;height:25px;font-size:28px">
								<img src="'.Yii::app()->request->baseUrl.'/images/barcode/barcode_0510006.bmp"></img>
								<p>'.$kode_barang.'</p>
								';
	$html.='
								</td>';
							}
	$html.='
							</tr>
							<tr>
								<td style="height:50px">&nbsp;</td>
							</tr>						
							';
								}
	$html.='
						</table>';

if($mode=="pdf"){
			Yii::import('application.exstensions.MPDF54.*'); // ext MPDF
			require_once("mpdf.php");
			//$mode='',$format='A4',$default_font_size=0,$default_font='',$mgl=15,$mgr=15,$mgt=16,$mgb=16,$mgh=9,$mgf=9, $orientation='P'
			/*$pdf = new mpdf('','A4','8','',8,8,5,5,5,5);
			$pdf->AddPage('p');
			
			$pdf->WriteHtml($html);
			
			$pdf->Output(); */
			/*-------------------add page-------------------------*/
			$pdf = new mpdf('','A4',8,'',5,5,15,15); // kiri,kanan,atas,bawah
			$pdf->AddPage();//membuat halaman baru di pdf
			$html.= '
			<htmlpageheader name="MyHeader1">
			<div style="text-align: right; border-bottom: 1px solid #000000; font-weight: bold; font-size: 10pt;">Barcode</div>
			</htmlpageheader>

			<sethtmlpageheader name="MyHeader1" value="on" show-this-page="1" />
			<sethtmlpagefooter name="MyFooter1" value="on" />';

			/*for($i = 1 ;$i <= 50; $i++){
			$html.= '
			<div>Start of the document ... and all the rest '.$i.'</div>
			';
			}*/
			$pdf->WriteHTML($html);
			$pdf->Output();
			
			/*-------------------add page-------------------------*/
			
		}else{
		echo $html;
		}?>