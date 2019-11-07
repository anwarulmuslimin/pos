<br/><br/>
<div class="row">
    <div class="col-md-6">
    <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/format_import.png" alt="User Image" width="550px"><br/><br/>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="box box-warning">
            <div class="box-header with-border">
                <h3 class="box-title">Import Data</h3>
            </div>
            <form onSubmit="return validateForm()" role="form" action="<? echo Yii::app()->createUrl('items/import_item');?>" method="POST" enctype="multipart/form-data">
                <div class="box-body">
                    <div class="form-group">
                        <label for="InputFile">File input</label>
                        <input type="file" id="dataitem" name="dataitem" style="cursor:pointer">
                    </div>
                    <div class="checkbox">
                        <label style="font-size:11px">
                        <b>Format Import excel (*.xls) </b>
                        </label>
                    </div>
                </div>
                <div class="box-footer">
                <button type="submit" class="btn btn-bni">Upload</button>
                </div>
            </form>
            <?php/* $form=$this->beginWidget('CActiveForm', array(
                'id'=>'excel-form',
                'enableAjaxValidation'=>false,
                'action'=>Yii::app()->createUrl('items/proses_import'),
                    'htmlOptions'=>array('enctype'=>'multipart/form-data'),
            )); ?>
                 <div class="box-body">
                    <? $model   = new PosItem;?>
                    <?php echo $form->fileField($model,'filee',array('size'=>60,'maxlength'=>200,)); ?>
                    <div class="checkbox">
                        <label style="font-size:11px">
                        <b>Format Import excel (*.xls) </b>
                        </label>
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-bni">Upload</button>
                    </div>
            <?php $this->endWidget(); */?>
        </div>
    </div>
</div>

<script type="text/javascript">
//    validasi form (hanya file .xls yang diijinkan)
    function validateForm()
    {
        function hasExtension(inputID, exts) {
            var fileName = document.getElementById(inputID).value;
            return (new RegExp('(' + exts.join('|').replace(/\./g, '\\.') + ')$')).test(fileName);
        }
 
        if(!hasExtension('dataitem', ['.xls'])){
            alert("Hanya file XLS (Excel 2003) yang diijinkan.");
            return false;
        }
    }
</script>