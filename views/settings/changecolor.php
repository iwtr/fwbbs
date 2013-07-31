<?php
/*
 * $this SettingController
 * $model Settings
 */

$this->breadcrumbs = array(
		'色変更'
);

$this->menu = array(
		array('label' => 'ページ毎表示件数変更', 'url' => array('setpager')),
		array('label' => 'NGワード設定', 'url' => array('setngwords')),
		array('label' => '色変更', 'linkOptions' => array('style' => 'font-weight: bold; font-size: 13px;'))
);
?>

<h3>ページ内の色を変更します。</h3>

<?php
$this->renderPartial('_colorform', array(
		'model' => $model
));
