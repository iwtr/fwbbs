<?php
/* @var $this BoardController */
/* @var $board Board */

Yii::app()->clientScript->registerScript('cform',
				"$('#toggle_sw').click(function(){ $('#comment-form').slideToggle('slow');}).next().hide();");

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

<h1><?php echo hide_ngword($board->title); ?></h1>

<span id="toggle_sw">投稿フォーム</span>
<div id="comment-form">
<?php
$this->renderPartial('/comment/_form', array(
		'comment' => $comment,
		'board_id' => $board->id,
));
?>
</div>

<div id="comments">
	<?php
	$cbg = loadSetting('color_commentbg');
	//コメントのページング
	$this->widget('zii.widgets.CListView', array(
			'dataProvider'=>$dataProvider,
			'itemView'=>'_comments',
			'viewData' => array('cbg' => $cbg)
	));
	
	?>
</div>

