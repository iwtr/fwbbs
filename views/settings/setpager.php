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
		array('label' => 'ページ毎表示件数変更', 'linkOptions' => array('style' => 'font-weight: bold; font-size: 13px;')),
		array('label' => 'NGワード設定', 'url' => array('setngwords'))
);

?>

<h3>１ページ内に表示するトピック・コメント件数を変更します。</h3>

<?php

$this->renderPartial('_pagerform', array(
		'model' => $model
));