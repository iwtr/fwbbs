<?php
/* @var $this BoardController */
/* @var $board Board */

$this->breadcrumbs=array(
	'トピック一覧'=>array('index'),
	$board->title,
);

$linkoption = Yii::app()->user->checkAccess('deleteOwnBoard', array('board' => $board))||isAdmin() ?
				array('submit'=>array('delete','id'=>$board->id), 'confirm'=>'本当に削除しますか？') :
				array('submit'=>array('delete','id'=>$board->id));

$this->menu=array(
	array('label'=>'トピック一覧へ', 'url'=>array('index')),
	array('label'=>'新しくトピックを作る', 'url'=>array('create')),
	array(
			'label'=>'タイトル変更',
			'url'=>array('update','id'=>$board->id),
			//'visible' => Yii::app()->user->checkAccess('updateOwnBoard', array('board' => $board)),
	),
	array('label'=>'トピック削除',
			'url'=>'#',
			'linkOptions'=>$linkoption,
			//'visible' => Yii::app()->user->checkAccess('deleteOwnBoard', array('board' => $board)),
	),
	array(
			'label'=>'管理メニュー',
			'url'=>array('admin'),
			'visible' => isAdmin(),
	),
);
?>

<h1><?php echo $board->title; ?></h1>

<?php
/*
$this->widget('zii.widgets.CDetailView', array(
	'data'=>$board,
	'attributes'=>array(
		'id',
		'title',
		'del_key',
		'created_at',
		'last_updated',
	),
));
*/
/*
Yii::app()->user->testPrint($board->comments);
$this->widget('zii.widgets.CDetailView', array(
	'data'=>$board->comments,
	'attributes'=>array(
			'id',
			'pen_name',
			'contents',
			'image',
	),
));
*/

?>

<div id="comments">
	<?php
	/*
	$this->renderPartial('_comments',array(
			'comments' => $board->comments,
	));
	*/
	?>
	
	<?php
	
	//コメントのページング
	$this->widget('zii.widgets.CListView', array(
			'dataProvider'=>$dataProvider,
			'itemView'=>'_comments',
	));
	
	?>
	
	<?php
	//$cc = new CommentController;
	$this->renderPartial('/comment/_form', array(
			'comment' => $comment,
			'board_id' => $board->id,
	));
	?>
</div>

