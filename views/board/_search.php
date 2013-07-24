<?php
/* @var $this BoardController */
/* @var $model Board */
/* @var $form CActiveForm */
?>

<div class="wide form">
	<?php $form=$this->beginWidget('CActiveForm', array(
		'action'=>Yii::app()->createUrl($this->route),
		'method'=>'get',
	)); ?>
	
	<?php  ?>
	
	<div class="row">
		<?php echo $form->label($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>128)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'created_at'); ?>
		<?php echo $form->textField($model,'created_at'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->label($model,'user_id', array('label' => '作者名')); ?>
		<?php echo $form->textField($model,'user_id', array('value' => $model->user->name));//作者名を入力 search()内でuser_idに直す ?>

	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>
	
	<?php $this->endWidget(); ?>
	
</div><!-- search-form -->