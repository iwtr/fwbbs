<?php
/* @var $this CommentController */
/* @var $model Comment */

$this->breadcrumbs=array(
	'Comments'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Delete',
);
?>

<h1>コメント削除 #<?php echo $model->id; ?></h1>

<?php
echo $this->renderPartial('/board/_comments', array('data' => $model));

echo $this->renderPartial('_delete', array('model' => $model));
?>
