<?php
/* @var $this CommentController */
/* @var $model Comment */

$this->breadcrumbs=array(
	'管理メニュー',
);

$this->menu=array(
	//array('label'=>'List Comment', 'url'=>array('index')),
	//array('label'=>'Create Comment', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#comment-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>管理メニュー</h1>

<p>検索条件に比較演算子(<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>, <b>=</b>)が使えます。</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'comment-grid',
	'ajaxUpdate' => false,
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'board_id',
		'user_id',
		//'del_key',
		'pen_name',
		'contents',
		array('name' => 'image'),
		'created_at',
		
		array(
				'class'=>'CButtonColumn',
				
		),
	),
)); ?>
