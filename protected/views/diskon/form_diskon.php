
    <table class="table table-bordered table-hover table-condensed" width="100%">
        <tr>
            <th width="5%">No</th>
            <th>Kode Barang</th>
            <th>Nama Barang</th>
            <th>Stock Barang</th>
            <th>Harga Jual</th>
            <th colspan="2">% Diskon</th>
        </tr>
        <? $urut = 1; ?>
        <? foreach($barang as $data){?>
        <? $harga   = $this->GetHargaItem($data->kode);?>
        <?
            $cek_diskon             = new CDbCriteria;
            $cek_diskon->condition  = "kode='".$data->kode."' and lokasi='".$lokasi."'";
            $modiskon               = TempDiskon::model()->find($cek_diskon);
            $diskon_1               = $modiskon->diskon_1;
            $diskon_2               = $modiskon->diskon_2;
        ?>
        <tr>
            <td><? echo $urut; ?></td>
            <td><? echo  $data->kode; ?></td>
            <td><? echo  $this->GetNamaItem($data->kode); ?></td>
            <td><? echo  $data->stock_toko; ?></td>
            <td style="text-align:right;"><? echo  $this->Uang($harga);?></td>
            <th><input type="hidden" id="kode_<?=$urut;?>" name="kode_<?=$urut;?>" value="<?=$data->kode;?>">
                <input maxlength="2" type="text" class="form-control" style="width:80px;" name="nominal_<?=$urut;?>"  id="nominal_<?=$urut;?>"  onkeypress="return Numeric(event);" value="<?=$diskon_1;?>"></th>
            <td>
                <? if($diskon_1 !=''){?>
                    <input maxlength="2" type="text" class="form-control" style="width:80px;" name="nominal2_<?=$urut;?>"  id="nominal2_<?=$urut;?>"  onkeypress="return Numeric(event);" value="<?=$diskon_2;?>">
                <?}?>
            </td>
        </tr>
        <?$urut++; ?>
        <?}?>
        <?$total_barang = $urut-1;?>
        <input type="hidden" name="total_barangdiskon" id="total_barangdiskon" value="<?=$total_barang;?>" >
    </table>
    <a onclick="simpan_diskon();" class="btn btn-success"><i class="fa fa-checklist"></i> simpan</a>
