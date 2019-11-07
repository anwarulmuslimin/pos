<? if($mode=='excel'){
	$file	= "Rekap_Kasir.xls";
	header("Content-type: application/vnd.ms-excel");
	header("Content-Disposition: attachment; filename=$file");
	
	$element = ' border=1 cellspacing=0 cellpadding=0 width="100%"';
}else{
    $element = ' class="table table-condensed table-bordered table-hover" width="100%"';
}?>
<center><b>Kasir : <? echo $user_name; ?></b><br/></center>
<table <? echo $element; ?>>
    <tr>
        <th>NoNota</th>
        <th>Kode</th>
        <th>Nama Barang</th>
        <th>@/Harga</th>
        <th>Diskon</th>
        <th>Jumlah Barang</th>
        <th>Jumlah Penjualan</th>
    </tr>

    <? foreach($data as $data){?>
    <? $harga_total     = $data->iJumlah*$data->iharga; ?>
    <tr>
        <td><? echo $data->iNonota; ?></td>
        <td><? echo $data->iKodeBr; ?></td>
        <td><? echo $this->GetNamaItem($data->iKodeBr); ?></td>
        <td style="text-align:right"><? echo $this->Uang($data->iharga); ?></td>
        <td style="text-align:right"><? echo $this->Uang($data->idiskon); ?></td>
        <td style="text-align:center"><? echo $data->iJumlah; ?></td>
        <td style="text-align:right"><? echo $this->Uang($harga_total); ?> </td>
    </tr>
    <?
        $tot_harga  = $tot_harga + $data->iharga;
        $tot_diskon = $tot_diskon+ $data->idiskon;
        $tot_barang = $tot_barang + $data->iJumlah;
        $tot_penjualan  = $tot_penjualan + $harga_total;
    
    ?>
    <?}?>
    <tr>
        <td colspan='3'>Total</td>
        <td style="text-align:right"><? echo $this->Uang($tot_harga); ?></td>
        <td style="text-align:right"><? echo $this->Uang($tot_diskon); ?></td>
        <td style="text-align:center"><? echo $tot_barang; ?></td>
        <td style="text-align:right"><? echo $this->Uang($tot_penjualan); ?></td>
    </tr>
</table>

