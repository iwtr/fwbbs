<?php
/* @var $this BoardController */
/* @var $model Board */

$this->breadcrumbs=array(
	'トピック一覧'=>array('index'),
	'新規トピック作成',
);

$this->menu=array(
	array('label'=>'トピック一覧', 'url'=>array('index')),
	array('label'=>'管理メニュー', 'url'=>array('admin')),
);
?>

<h1>新規トピック作成</h1>

<?php
echo $this->renderPartial('_form', array(
		//'model'=>$model,
		'board' => $board,
		'comment' => $comment,
));
?>