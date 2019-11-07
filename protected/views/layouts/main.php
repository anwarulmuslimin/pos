<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>G-POS</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/bower_components/jvectormap/jquery-jvectormap.css">
  <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/bower_components/select2/dist/css/select2.min.css">
  <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/font.css">  
  <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/FreeSansBold.ttf">
  
  <link href="<?php echo Yii::app()->request->baseUrl; ?>/images/icon.png" rel='icon' type='image/x-icon'/>

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  
</head>
<body class="hold-transition skin-yellow-light sidebar-mini">
    <div class="wrapper">
      <header class="main-header">
	      <a href="<?php echo Yii::app()->request->baseUrl; ?>" class="logo" style="position:fixed">
          <span class="logo-mini"><b>POS</b> </span>
          <span class="logo-lg">
            <b>&nbsp; Point Of Sales</b>
          </span>
        </a>  <!-- Menu Top -->
	      <? $this->widget('User');?>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar" style="position: fixed;">
        <? $this->widget('leftSide');?>
      </aside>
        <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper"   style="min-height:850px;"><br/><br/><?php echo $content; ?></div>
      <!-- /.content-wrapper -->
      <footer class="main-footer">
        <strong>Copyright &copy;  </strong> 2018
      </footer>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/bower_components/jquery/dist/jquery.min.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/bower_components/fastclick/lib/fastclick.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/dist/js/adminlte.min.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>

<script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/bower_components/Chart.js/Chart.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/dist/js/pages/dashboard2.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/dist/js/demo.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/barcode/jquery-barcode.min.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/xepOnline.jqPlugin.js"></script>
</body>
</html>
<div class="modal modal-default fade" id="myModalBantuan">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Bantuan</h4>
      </div>
      <div class="modal-body" id="view_bantuan"></div>
    </div>
  </div>
</div>
<script type="text/javascript">

            function loadManualBook(id)
            {
                $.ajax({
                    type		: "POST",
                    url			: "<?= Yii::app()->createUrl('manualbook/index'); ?>",
                    data		: "id="+id,
                    cache		: false,
                    success		: function(html)
                    {
                        $("#view_bantuan").html(html);
                    }
                });
            }
        </script>
