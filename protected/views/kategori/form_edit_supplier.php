	<table class="table" width="100%">
    <tr>
        <td>
            <label>Nama Supplier</label>
            <input type="text" class="form-control" id="update_supplier" name="update_supplier" value="<? echo $model->perusahaan;?>"/>
            <input type="hidden" class="form-control" id="update_supplier_id" name="update_supplier_id" value="<? echo $model->no_id;?>"/>
        </td>
    </tr>
    <tr>
        <td>
            <label>Alamat Supplier</label>
            <textarea type="text" class="form-control" id="alamat_update_supplier" name="alamat_update_supplier"> <? echo $model->alamat;?></textarea>
        </td>
    </tr>
    <tr>
        <td>
            <label>Telp Supplier</label>
            <input type="text" class="form-control" id="telp_update_supplier" name="telp_update_supplier" onkeypress="return Numeric(event)"  value="<? echo $model->telp;?>"/>
        </td>
    </tr>
    <tr>
        <td>
            <div class="btn-group">
                <button type="button" class="btn btn-bni pull-left" data-dismiss="modal">Batal</button>
                <a onclick="update_supplier(<? echo $model->no_id;?>);" data-dismiss="modal" class="btn btn-bni">Simpan </a>
            </div>
        </td>
    </tr>
    </table>
 