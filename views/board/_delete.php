<?php
/* @var $this BoardController */
/* @var $board Board */
/* @var $form CActiveForm */

?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'board-form',
	'focus' => 'input:first',
	'enableAjaxValidation'=>false,
)); ?>
	
	<?php
	echo $form->errorSummary($board);
	?>
	<div class="row">
		<?php echo $form->labelEx($board,'del_key'); ?>
		<?php echo $form->textField($board,'del_key',array('value'=>'', 'size'=>4,'maxlength'=>4)); ?>
		<?php echo $form->error($board,'del_key'); ?>
	</div>
	

	<div class="row buttons">
		<?php echo CHtml::submitButton('削除', array('confirm'=>'本当に削除しますか？'));//, array('name' => 'confirm')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
