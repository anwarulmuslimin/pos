<table class="table table-condensed table-hover" width="100%">
    <tr>
        <th>No</th>
        <th>Kode Barang</th>
        <th>Nama Barang</th>
        <th>Tanggal</th>
        <th>Jumlah</th>
        <th>Alasan</th>
        <th> <input type="checkbox" name="pilihsemua" id="pilihsemua"></th>
    </tr>
    <? $urut=1;?>
    <? foreach($modal as $data){?>
    <tr>
        <td><? echo $urut; ?></td>
        <td><? echo $data->kode; ?></td>
        <td><? echo $data->nama_barang; ?></td>
        <td><? echo $data->tgl; ?></td>
        <td><? echo $data->jml; ?></td>
        <td><? echo $data->alasan; ?></td>       
        <td>
            <input class="pilih" type="checkbox" name="pilih_<?=$urut;?>" id="pilih_<?=$urut;?>" value="<?=$data->kode;?>">
        </td>
    </tr>
    <? $urut++;?>
    <?}?>
</table>
<input type="hidden" name="total_urut" id="total_urut" value="<?=$urut; ?>">
<? if($urut > 1){?>
    <a href="javascript::proses" onclick="proses_returpembelian();" class="btn btn-bni"><i class="fa fa-check"></i> proses retur</a>
<?}?>

<script>
$(function(){
    
    // Fungsi Checkbox Pilih Semua
    $("#pilihsemua").click(function () { // Jika Checkbox Pilih Semua di ceklis maka semua sub checkbox akan diceklis juga
    $('.pilih').attr('checked', this.checked);
    });
    
    // Jika semua sub checkbox diceklis maka Checkbox Pilih Semua akan diceklis juga
    $(".pilih").click(function(){
    
        if($(".pilih").length == $(".pilih:checked").length) {
            $("#pilihsemua").attr("checked", "checked");
        } else {
            $("#pilihsemua").removeAttr("checked");
        }
        
    });
 });
</script>