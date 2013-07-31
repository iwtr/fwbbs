<?php
/*
 * $this SettingController
 * $model NGWord
 */

//Yii::app()->clientScript->registerCoreScript('jquery');
Yii::app()->clientScript->registerScript('odd', "$('.ngwords .row:odd').css('background-color', '#eee');");
Yii::app()->clientScript->registerScript('even', "$('.ngwords .row:even').css('background-color', '#ffc');");


$this->breadcrumbs = array(
		'設定' => array('index'),
		'NGワード設定'
);

$this->menu = array(
		array('label' => 'ページ毎表示件数変更', 'url' => array('setpager')),
		array('label' => 'NGワード設定', 'linkOptions' => array('style' => 'font-weight: bold; font-size: 13px;'))
);
?>

<h2>NGワードを設定します。</h2>
<p>現在のNGワードリスト</p>

<div class="ngwords">
	
<?php
	$this->widget('zii.widgets.CListView', array(
			'dataProvider' => $dataProvider,
			'itemView' => '_ngword',
			'enablePagination' => false,

	));
?>
</div>

<div class="clear"></div>

<?php
$this->renderPartial('_ngform', array(
		'model' => $model
));