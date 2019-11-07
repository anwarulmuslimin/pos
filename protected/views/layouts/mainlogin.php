<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
	<link rel="stylesheet" type="text/css" media="all" href="<?=Yii::app()->baseUrl;?>/niceforms-default.css" />

	<link href="<?=Yii::app()->baseUrl;?>/css/login/animation.css"  rel="stylesheet" type="text/css">
	<link href="<?=Yii::app()->baseUrl;?>/css/login/orange.css"     rel="stylesheet" type="text/css">
	<link href="<?=Yii::app()->baseUrl;?>/css/login/preview.css"    rel="stylesheet" type="text/css">
	<link href="<?=Yii::app()->baseUrl;?>/css/login/authenty.css"   rel="stylesheet" type="text/css">

	<script src="<?=Yii::app()->baseUrl;?>/css/js/jquery.min.js"></script>
	<script src="<?=Yii::app()->baseUrl;?>/css/js/jquery-ui.min.js"></script>
	<script src="<?=Yii::app()->baseUrl;?>/css/js/jquery.icheck.min.js"></script>
	<script src="<?=Yii::app()->baseUrl;?>/css/js/waypoints.min.js"></script>

	<!-- authenty js -->
	<script src="<?=Yii::app()->baseUrl;?>/css/js/authenty.js"></script>

	<!-- preview scripts -->
	<script src="<?=Yii::app()->baseUrl;?>/css/js/preview/jquery.malihu.PageScroll2id.js"></script>
	<script src="<?=Yii::app()->baseUrl;?>/css/js/preview/jquery.address-1.6.min.js"></script>
	<script src="<?=Yii::app()->baseUrl;?>/css/js/preview/scrollTo.min.js"></script>
	<script src="<?=Yii::app()->baseUrl;?>/css/js/preview/init.js"></script>

	<!-- bacground berganti warna -->
	<style type="text/css">
	body{
		background-color  : #f1c40f;
		-webkit-animation : color 8s ease-in  0s infinite alternate running;
		-moz-animation    : color 8s linear  0s infinite alternate running;
		animation         : color 8s linear  0s infinite alternate running;
	  }

	  /* Animasi + Prefix untuk browser */
	  @-webkit-keyframes color {
		  0% { background-color: #f1c40f; }
		  32% { background-color: #e74c3c; }
		  55% { background-color: #9b59b6; }
		  76% { background-color: #16a085; }
		  100% { background-color: #2ecc71; }
	  }
	  @-moz-keyframes color {
		   0% { background-color: #f1c40f; }
		  32% { background-color: #e74c3c; }
		  55% { background-color: #9b59b6; }
		  76% { background-color: #16a085; }
		  100% { background-color: #2ecc71; }
	  }
	  @keyframes color {
		0% { background-color: #f1c40f; }
		  32% { background-color: #e74c3c; }
		  55% { background-color: #9b59b6; }
		  76% { background-color: #16a085; }
		  100% { background-color: #2ecc71; }
	  }
	</style>
</head>
<body>
	<section id="signin_main" class="authenty signin-main" style="height:677px;">
		<div class="section-content" height="800px">
		  <div class="wrap">
			  <div class="container">     
					<div class="form-wrap">
						<div class="row">
						  <div class="title" data-animation="fadeInDown" data-animation-delay=".8s">
							  <h1><?php echo CHtml::encode(Yii::app()->name); ?></h1>
						  </div>
							<div id="form_1" data-animation="bounceIn">
								<div class="form-header">
									<img src="<? echo Yii::app()->baseUrl.'/images/logo_p6id.png';?>" width="80" height="80">
									<img src="<? echo Yii::app()->baseUrl.'/images/logo_bni.png';?>" width="60" height="30">
								</div>
							  <div class="form-main">
								  <? echo $content;?>
							  </div>
								<div class="form-footer" style="color:white;">
									 SIS + Platinnum | Powered by &nbsp;&nbsp;
									<a href="#" target="_blank">
										<img src="<? echo Yii::app()->baseUrl;?>/images/project_6.jpg" alt="" title="" border="0" width="80" height="30" />
									</a>
								</div>      
						  </div>
						</div>
					</div>
			  </div>
		  </div>
		</div>
	</section>
	<script>
		(function($) {
			
			// get full window size
			$(window).on('load resize', function(){
				var w = $(window).width();
				var h = $(window).height();

				$('section').height(h);
			});     

			// scrollTo plugin
			$('#signup_from_1').scrollTo({ easing: 'easeInOutQuint', speed: 1500 });
			$('#forgot_from_1').scrollTo({ easing: 'easeInOutQuint', speed: 1500 });
			$('#signup_from_2').scrollTo({ easing: 'easeInOutQuint', speed: 1500 });
			$('#forgot_from_2').scrollTo({ easing: 'easeInOutQuint', speed: 1500 });
			$('#forgot_from_3').scrollTo({ easing: 'easeInOutQuint', speed: 1500 });
			
			
			// set focus on input
			var firstInput = $('section').find('input[type=text], input[type=email]').filter(':visible:first');
	
			if (firstInput != null) {
		firstInput.focus();
	}
			
			$('section').waypoint(function (direction) {
				var target = $(this).find('input[type=text], input[type=email]').filter(':visible:first');
				target.focus();
			}, {
		  offset: 300
	  }).waypoint(function (direction) {
				var target = $(this).find('input[type=text], input[type=email]').filter(':visible:first');
			target.focus();
	  }, {
		  offset: -400
	  });
			
			
			// animation handler
			$('[data-animation-delay]').each(function () {
		  var animationDelay = $(this).data("animation-delay");
		  $(this).css({
			  "-webkit-animation-delay": animationDelay,
			  "-moz-animation-delay": animationDelay,
			  "-o-animation-delay": animationDelay,
			  "-ms-animation-delay": animationDelay,
			  "animation-delay": animationDelay
		  });
	  });
			
	  $('[data-animation]').waypoint(function (direction) {
		  if (direction == "down") {
			  $(this).addClass("animated " + $(this).data("animation"));
		  }
	  }, {
		  offset: '90%'
	  }).waypoint(function (direction) {
		  if (direction == "up") {
			  $(this).removeClass("animated " + $(this).data("animation"));
		  }
	  }, {
		  offset: '100%'
	  });
		
		})(jQuery);
    </script>		
</body>
</html>