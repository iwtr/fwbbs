<?php
/* @var $this UsersController */
/* @var $model Users */

$this->breadcrumbs=array(
	'Users'=>array('index'),
	$model->name,
);

$this->menu=array(
	//array('label'=>'ユーザー一覧', 'url'=>array('index')),
	//array('label'=>'ユーザー新規登録', 'url'=>array('create')),
	array('label'=>'ユーザー情報更新', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'ユーザー削除', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'本当に削除しますか？')),
	array('label'=>'管理メニュー', 'url'=>array('admin')),
);
?>

<h1>ユーザー情報詳細 #<?php echo $model->id; ?></h1>

<?php 
$admin = $model->admin ? '○' : '×';
$this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'login_id',
		//'password',
		'name',
		'address',
		//'admin',
		array(
				'label' => 'is admin',
				'value' => "$admin",
		),
	),
)); 

$this->widget('zii.widgets.CDetailView', array(
		'data' => Settings::model()->find('user_id=:user_id', array(':user_id' => Yii::app()->user->id)),
		'attributes' => array(
				'boardPerPage',
				'commentPerPage'
		),
));
