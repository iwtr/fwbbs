<?php
/*
 * $this SettingController
 * $model Settings
*/

$this->breadcrumbs = array(
		'設定' => array('index'),
		'ページ毎表示件数変更'
);

$this->menu = array(
		array('label' => 'ページ毎表示件数変更', 'linkOptions' => array('style' => 'font-weight: bold;')),		
);

?>

<h3>１ページ内に表示するトピック・コメント件数を変更します。</h3>

<?php

$this->renderPartial('_form', array(
		'model' => $model
));