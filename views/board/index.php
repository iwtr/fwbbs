<?php
/* @var $this BoardController */
/* @var $dataProvider CActiveDataProvider */

Yii::app()->clientScript->registerScript('sform',
				"$('#search').click(function(){ $('.search-form').slideToggle('slow');}).next().hide();");
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

<span id="search" style="color: blue; text-decoration: underline;">検索フォーム</span>
<div class="search-form" style="width: 400px;">
	<h3>検索フォーム</h3>
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
