<table class="table table-bordered table-hover table-condensed" width="100%">
    <tr>
        <th colspan='7'> <?=$nama_toko; ?></th>
    </tr>
    <tr>
        <th>No</th>
        <th>Kode Barang</th>
        <th>Nama Barang</th>
        <th>Harga Barang</th>
        <th>Diskon</th>
        <th>Harga Diskon</th>
        <th>Toko</th>
    </tr>
    <? $urut = 1; ?>
    <? foreach($model as $data){?>
    <?  $harga_item     = $this->GetHargaItem($data->kode);
        $nom_diskon_1   = $data->nominal;
        $nom_diskon_2   = $data->nominal_2;
        $total_diskon   = $nom_diskon_1+$nom_diskon_2;
        $persen_1       = $data->diskon_1;
        $persen_2       = $data->diskon_2;
        $harga_diskon   = $harga_item - $total_diskon;

        if( $persen_2 > 0){
            $tampil_disk2   = "+".$this->Uang($data->nominal_2)." ( ".$persen_2."%)";
        }else{
            $tampil_disk2   = "";
        }
        
    ?>
    <tr>
        <td><? echo $urut; ?></td>
        <td style="text-align:center;"><? echo $data->kode; ?></td>
        <td style="text-align:left;"><? echo $this->GetNamaItem($data->kode); ?></td>
        <td style="text-align:right;"><? echo $this->Uang($harga_item); ?></td>
        <td style="text-align:left;"><? echo $this->Uang($nom_diskon_1); ?>(<b> <?=$persen_1;?>% </b>) <?=$tampil_disk2;?></td>
        <th style="text-align:right;"><? echo $this->Uang($harga_diskon); ?></th>
        <th style="text-align:center;"><? echo $this->GetNamaToko($data->lokasi);?></th>
    </tr>
    <?$urut++; ?>
    <?}?>
</table>