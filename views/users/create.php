<?php
/* @var $this UsersController */
/* @var $model Users */

$this->breadcrumbs=array(
	'Users'=>array('index'),
	'Create',
);

$this->menu=array(
	//array('label'=>'ユーザー一覧', 'url'=>array('index')),
	array('label'=>'管理メニュー', 'url'=>array('admin')),
);
?>

<h1>新規ユーザー登録</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>