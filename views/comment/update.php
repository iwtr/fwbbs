<?php
/* @var $this CommentController */
/* @var $model Comment */

Yii::app()->clientScript->registerScript('tareafocus',
				"$('#Comment_contents')
					.focus(function(){
						$(this).select();
						return false;
					})
					.click(function(){
						$(this).select();
					});"
);

$this->breadcrumbs=array(
	'Comments'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	//array('label'=>'List Comment', 'url'=>array('index')),
	//array('label'=>'Create Comment', 'url'=>array('create')),
	//array('label'=>'View Comment', 'url'=>array('view', 'id'=>$model->id)),
	//array('label'=>'Manage Comment', 'url'=>array('admin')),
);

?>

<h1>コメント更新 #<?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('/board/_comments', array('data' => $model)); ?>

<?php echo $this->renderPartial('_form', array('comment'=>$model)); ?>
