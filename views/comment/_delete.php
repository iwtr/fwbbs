<?php
/* @var $this CommentController */
/* @var $model Comment */
/* @var $form CActiveForm */
?>

<div class="form">

<?php

$form=$this->beginWidget('CActiveForm', array(
		'id'=>'comment-form',
		'focus' => 'input:first',
		'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>
	
	<div class="row">
		<?php echo $form->labelEx($model,'del_key'); ?>
		<?php echo $form->textField($model,'del_key',array('value' => '', 'size'=>4,'maxlength'=>4)); ?>
		<?php echo $form->error($model,'del_key'); ?>
	</div>
	
	<?php //echo $form->hiddenField($model, 'board_id', array('value'=>$board_id));?>
	<?php //echo $form->error($model, 'board_id'); ?>
	
	<div class="row buttons">
		<?php echo CHtml::submitButton('削除', array('confirm'=>'本当に削除しますか？')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->