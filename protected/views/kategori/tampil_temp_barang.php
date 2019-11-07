<table class="table table-bordered table-condensed table-hover" width="100%">
    <tr>    
        <th>No</th>
        <th>Kode Barang</th>
        <th>Nama Barang</th>
        <th>Jumlah</th>
        <th></th>
    </tr>
    <?if ($toko !=""){?>
    <? $urut    = 1;?>
    <? foreach($data as $data){?>
    <tr>
        <td><? echo $urut;?></td>
        <td><? echo $data->kode;?></td>
        <td><? echo $data->barang;?></td>
        <td><? echo $data->jml;?>
            <input type="hidden" id="batal_stok_<?=$urut;?>" name="batal_stok_<?=$urut;?>" value="<? echo $data->jml;?>">
        </td>
        <td><input type="checkbox" id="batal_urut_<? echo $urut;?>"  name="batal_urut_<? echo $urut;?>" value="<? echo $data->kode;?>"></td>
    </tr>
    <?
    $urut++;
    }?>
    <?}?>
    <input type="hidden" name="max_mutasi" id="max_mutasi" value="<? echo $urut; ?>">
</table>