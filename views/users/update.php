<?php
/* @var $this UsersController */
/* @var $model Users */

$this->breadcrumbs=array(
	'Users'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	//array('label'=>'List Users', 'url'=>array('index')),
	array('label'=>'ユーザー新規作成', 'url'=>array('create')),
	//array('label'=>'View Users', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'管理メニュー', 'url'=>array('admin'), 'visible' => isAdmin()),
);
?>

<h1>ユーザー情報更新</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>