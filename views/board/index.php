<?php
/* @var $this BoardController */
/* @var $dataProvider CActiveDataProvider */

Yii::app()->clientScript->registerScript('sform',
				"$('#toggle_sw').click(function(){ $('.search-form').slideToggle('slow');}).next().hide();");

$this->breadcrumbs=array(
	'トピック一覧',
);

$this->menu=array(
	array('label'=>'トピック作成', 'url'=>array('create')),
	//array('label' => 'トピック検索', 'url' => array('find')),
	array('label'=>'管理メニュー', 'url'=>array('admin'), 'visible'=>isAdmin()),
);
?>

<h1>トピック一覧</h1>

<span id="toggle_sw">検索フォーム</span>
<div class="search-form">
	<?php
	$this->renderPartial('_search',array(
		'model'=>$board,
	));
	?>
</div>

<?php
$this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
));
