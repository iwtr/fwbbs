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

<h1>Delete Board</h1>

<?php
echo $this->renderPartial('_delete', array(
		'board' => $board,
));
?>
