<input type="text" value="<? echo $form_update->jumlah; ?>" name="jumlah" id="jumlah" style="width:50px" onkeypress="return Numeric(event)">
<input type="hidden" value="<? echo $form_update->jumlah; ?>" name="jumlah_awal" id="jumlah_awal" style="width:50px">
<a onclick="update(<? echo $form_update->id; ?>)" class="btn btn-success btn-sm"><i class="fa fa-check"></i></a>
<a onclick="view_temp()" class="btn btn-success btn-sm"><i class="fa fa-remove"></i></a>
