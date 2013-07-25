<?php
/* @var $this BoardController */
/* @var $model Board */

$this->breadcrumbs=array(
	'Boards'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'トピック一覧', 'url'=>array('index')),
	array('label'=>'新規トピック作成', 'url'=>array('create')),
	//array('label'=>'View Board', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'管理メニュー', 'url'=>array('admin'), 'visible' => isAdmin()),
);
?>

<h1>タイトル更新</h1>

<?php echo $this->renderPartial('_form', array(
		//'model'=>$model,
		'board' => $model,
		
)); ?>