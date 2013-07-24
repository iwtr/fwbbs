<?php
/* @var $this BoardController */
/* @var $model Board */

$this->breadcrumbs=array(
	'トピック一覧'=>array('index'),
	'管理メニュー',
);

$this->menu=array(
	array('label'=>'トピック一覧', 'url'=>array('index')),
	array('label'=>'トピック作成', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#board-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>管理メニュー</h1>

<p>検索条件に比較演算子(<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>, <b>=</b>)が使えます。</p>

<?php echo CHtml::link('詳細検索','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php
$this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'board-grid',
		'dataProvider'=>$model->search(),
		'filter'=>$model,
		'selectableRows' => 0,
		'columns'=>array(
				'id',
				'title',
				//'del_key',
				'created_at',
				'last_updated',
				array(
						'class'=>'CButtonColumn',
				),
		),
)); ?>
