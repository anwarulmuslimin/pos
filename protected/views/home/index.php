<p class="login-box-msg">Login to Your Account</p>

	<?/* $username 	= $_GET[user];
	   $password 	= $_GET[pass];
	   $kosong 		= $_GET[kosong];

		Yii::app()->user->setFlash('error', 'Username atau password salah.<a class="close" data-dismiss="alert" href="#"></a>');
		Yii::app()->user->setFlash('warning', 'Username atau password tidak boleh kosong.<a class="close" data-dismiss="alert" href="#"></a>');
		Yii::app()->user->setFlash('success', 'Password berhasil diubah.<a class="close" data-dismiss="alert" href="#"></a>');
		if($username==1 or $password ==1){$info = 'error';}
		if($kosong==1){$info = 'warning';}
		if($logout==1){$info = 'success';}*/?>
    <form action="<? echo Yii::app()->createUrl('home/login');?>" method="post">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" name="username"  id="username" placeholder="Username">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" name="password" id="password" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox"> Remember Me
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
      </div>
	   <?/* $this->widget('bootstrap.widgets.TbAlert', array(
			'block'=>true, // display a larger alert block?
			'fade'=>true, // use transitions?
			'closeText'=>'&times;', // close link text - if set to false, no close link is displayed
			'alerts'=>array( // configurations per alert type
				$info=>array('block'=>true, 'fade'=>true, 'closeText'=>'&times;'), // success, info, warning, error or danger
			),
		)); */?>
    </form>