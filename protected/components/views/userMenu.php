<nav class="navbar navbar-fixed-top">
		<a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button"><span class="sr-only">Toggle navigation</span></a>

		<div class="navbar-custom-menu">
			<ul class="nav navbar-nav">
			  <li class="dropdown user user-menu">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" style="height: 49px;">
				  <img  src="<?php echo Yii::app()->request->baseUrl; ?>/images/logo_POS.png" class="user-image">
				  <span class="hidden-xs"></span>
				</a>
				<ul class="dropdown-menu">
				  <!-- User image -->
				  <li class="user-header">
					<img  src="<?php echo Yii::app()->request->baseUrl; ?>/images/logo_POS.png" class="img-circle" alt="Image">

					<p>
						<? 
						session_start();
						$sekolah_id 			= $_SESSION['sekolah_idlogin'];
						$cr_toko 					=  new CDbCriteria;
						$cr_toko->condition 	= "no_id='".$sekolah_id."'";
						$toko 								= TbToko::model()->find($cr_toko);
						echo $nama_toko 			= $toko->toko;
						?>
					  <small><? echo $alamat = $toko->alamat;?></small>
					</p>
				  </li>
				  <li class="user-footer">
					<div class="pull-left">
					  <a href="<? echo Yii::app()->createUrl('profil/index');?>" class="btn btn-default btn-flat">Profil</a>
					</div>
					<div class="pull-right">
					  <a href="<? echo Yii::app()->createUrl('home/logout');?>" class="btn btn-default btn-flat">Keluar</a>
					</div>
				  </li>
				</ul>
			  </li>
			</ul>
      </div> 
    </nav>