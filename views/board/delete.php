<?php
/* @var $this BoardController */
/* @var $board Board */
/* @var $form CActiveForm */
?>

<?php
$this->breadcrumbs=array(
	'Boards'=>array('index'),
	'Delete',
);
?>

<h1>トピック削除 #<?php echo $board->id; ?></h1>

<?php
echo $this->renderPartial('_delete', array(
		'board' => $board,
));
?>
