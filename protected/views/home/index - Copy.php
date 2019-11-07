<?
	   $username 	= $_GET[user];
	   $password 	= $_GET[pass];
	   $kosong 		= $_GET[kosong];

		Yii::app()->user->setFlash('error', 'Username atau password salah.<a class="close" data-dismiss="alert" href="#">&times;</a>');
		Yii::app()->user->setFlash('warning', 'Username atau password tidak boleh kosong.<a class="close" data-dismiss="alert" href="#">&times;</a>');
		Yii::app()->user->setFlash('success', 'Password berhasil diubah.<a class="close" data-dismiss="alert" href="#">&times;</a>');
		if($username==1 or $password ==1){$info = 'error';}
		if($kosong==1){$info = 'warning';}
		if($logout==1){$info = 'success';}?>
	<form action="<? echo Yii::app()->createUrl('home/login');?>" method="POST" class="niceform">
		<fieldset>
			<dl>
				<dt><label for="username">Username:</label></dt>
				<dd><input type="text" name="username" id="" value="" size="54" class="span4" /></dd>
			</dl>
			<dl>
				<dt><label for="password">Password:</label></dt>
				<dd><input type="password" name="password" id="" value="" size="54" class="span4" /></dd>
			</dl>
			<dl>
			<dt></dt>
			<dd>
			<?php $this->widget('bootstrap.widgets.TbButton', array(
				'buttonType'=>'submit',
				'type'=>'warning',
				'label'=>'LOGIN',
			)); ?>
			</dd>
			</dl>
		</fieldset>
		<?php $this->widget('bootstrap.widgets.TbAlert', array(
			'block'=>true, // display a larger alert block?
			'fade'=>true, // use transitions?
			'closeText'=>'&times;', // close link text - if set to false, no close link is displayed
			'alerts'=>array( // configurations per alert type
				$info=>array('block'=>true, 'fade'=>true, 'closeText'=>'&times;'), // success, info, warning, error or danger
			),
		)); ?>
	</form>
        