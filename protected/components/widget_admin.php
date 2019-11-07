<?php

class widget_admin extends CWidget
{
	public $hasilKuery;
	public $hasilKuery2;
	public $cssClass='portlet';
	public $headerCssClass='header';
	public $contentCssClass='content';
	public $visible=true;

	public function run()
	{
		$this->render('widget_admin');
	}
}