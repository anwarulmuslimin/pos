    <section class="sidebar">
	<div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/logo_POS.png" class="img-circle" height="100px"/>
        </div>
        <div class="pull-left info">
          <p style="color:#000;"><? echo $profil_Sekolah->pos_profil_nama;?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
         
        </div>
      </div>
      <ul class="sidebar-menu" data-widget="tree">
      <? session_start();
        if($_SESSION['username_status']=="Admin"){
            $this->widget('widget_admin');
            $this->widget('widget_master');
        }elseif($_SESSION['username_status']=="kasir"){
            $this->widget('widget_kasir');
        }else{

        }
        ?> 
		 
     <?  if($_SESSION['username_status']=="Admin"){?>  
      <li class="header">USER</li>    
        <li><a href="<? echo Yii::app()->createUrl('home/create_casier');?>"><i class="fa fa-list"></i> <span>Daftar User</span></a></li>
        <li><a href="<? echo Yii::app()->createUrl('profil/index');?>"><i class="fa fa-user"></i> <span>Profil</span></a></li>
     <?}elseif($_SESSION['username_status']=="kasir"){?>
      <li class="header">USER</li>
        <li><a href="<? echo Yii::app()->createUrl('home/change_password');?>"><i class="fa fa-exchange"></i> <span>Ganti Password</span></a></li>
		    <li><a href="<? echo Yii::app()->createUrl('home/logout');?>"><i class="fa fa-power-off"></i> <span>Keluar</span></a></li>
     <?}else{?>
      <li><a href="<? echo Yii::app()->createUrl('home/login');?>"><i class="fa fa-power-on"></i> <span>Login</span></a></li>
     <?}?>
    </ul>
    </section>
