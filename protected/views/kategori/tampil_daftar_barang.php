<table class="table table-bordered table-condensed table-hover" width="100%">
    <tr>    
        <th>No</th>
        <th>Kode Barang</th>
        <th>Nama Barang</th>
        <th>Stok Gudang</th>
        <th width="15%"></th>
        <th></th>
    </tr>
<?  if ($supplier !=""){
        $urut    = 1;
        foreach($data as $data){?>
            <tr>
                <td><? echo $urut;?></td>
                <td><? echo $data->kode;?></td>
                <td><? echo $data->nama_barang;?></td>
                <td><? echo $data->stok_gudang;?>
                    <input type="hidden" name="stok_<? echo $urut; ?>" id="stok_<? echo $urut; ?>" value="<?=$data->stok_gudang?>">
                </td>
                <td><input onkeypress="return Numeric(event);" onkeyup="cek_maxstok(<? echo $urut;?>);" type="text" class="form-control" name="jml_<? echo $urut; ?>" id="jml_<? echo $urut; ?>"></td>
                <td><input type="checkbox" id="urut_<? echo $urut;?>"  name="urut_<? echo $urut;?>"  value="<?=$data->kode?>"></td>
            </tr>
    <?
            $urut++;
        }
    }?>
    <input type="hidden" name="max_urut" id="max_urut" value="<? echo $urut; ?>">
</table>

<script type="text/javascript">  
    function Numeric(evt) {
			var charCode = (evt.which) ? evt.which : event.keyCode
			if (charCode > 31 && (charCode < 48 || charCode > 57))
			return false;
			return true;
	}


    function cek_maxstok(id)
    {	
        var stok    = $("#stok_"+id).val();
        var dimutasi= $("#jml_"+id).val();
        
        if(dimutasi > stok){
            alert("Jumlah yang dimutasikan melebihi stok gudang, maksimal hanya " + stok + " !");
            $("#jml_"+id).val(stok);
            return false;
        }

    }
</script>