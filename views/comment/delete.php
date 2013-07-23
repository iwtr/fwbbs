<?php
/* @var $this CommentController */
/* @var $model Comment */

$this->breadcrumbs=array(
	'Comments'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Delete',
);
?>

<h1>Delete Comment <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_delete', array('model'=>$model)); ?>
