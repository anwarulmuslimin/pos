<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>LOGIN</title>
  
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link href="<?php echo Yii::app()->request->baseUrl; ?>/images/icon_login.png" rel='icon' type='image/x-icon'/>
  <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/plugins/iCheck/square/blue.css">

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a style="color:white" href="<? echo Yii::app()->baseUrl;?>"><b>POS</b></a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <? echo $content;?>

    <!--<a href="#">I forgot my password</a><br>
    <a href="register.html" class="text-center">Register a new membership</a>-->
  </div>
  <!-- /.login-box-body -->
        <p style="color:white;text-align:right"><strong>Copyright &copy;  </strong> 2018</p>
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
</body>
</html>
