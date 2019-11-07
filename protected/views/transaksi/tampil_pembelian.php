<table class="table table-hover table-condensed" width="100%">
    <tr>
        <th>No</th>
        <th>Kode</th>
        <th>Nama Barang</th>
        <th>Harga Beli</th>
        <th>No Faktur</th>
        <th>Tanggal</th>
        <th>Qty</th>
        <th></th>
    </tr>
    <? $urut=1;?>
    <? foreach($pembelian as $data){?>
    <tr>
        <td><? echo $urut;?></td>
        <td> <? echo $data->kode; ?></td>
        <td> <? echo $data->barang; ?></td>
        <td> <? echo $data->harga; ?></td>
        <td> <? echo $data->nota; ?></td>
        <td> <? echo $data->tgl; ?></td>
        <td> <? echo $data->jumlah; ?></td>
        <td> <a onclick="batal(<? echo $data->kode;?>);" class="btn btn-flat btn-danger btn-sm"><i class="fa fa-remove"></i> batal</a> </td>
    </tr>
    <? $urut++;?>
    <?}?>
</table>
<? if($urut > 1){?>
<a class="btn btn-bni" onclick="proses pembelian();"><i class="fa fa-check"></i> Proses</a>
<?}?>