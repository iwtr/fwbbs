<?php
Yii::import('zii.widgets.CPortlet');

class UserMenu extends CPortlet
{
	public function init()
	{
		$this->title='ユーザー情報';
		parent::init();
	}
	
	protected function renderContent()
	{
		$this->render('userMenu');
	}
}

?>