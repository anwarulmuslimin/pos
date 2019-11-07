
<form name="formupload" method="post" enctype="multipart/form-data" action="<? echo Yii::app()->createUrl('profil/upload_logo');?>" >
    Upload Logo : <br>
    <input name="picture" type="file">
    <button class="btn btn-bni" type="submit"  name="upload" value="Upload" >Upload</button>
</form>