<?php
/* @var $this UsersController */
/* @var $model Users */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'users-form',
	'focus' => 'input:text[value=""]:visible:enabled:first',
	'enableAjaxValidation'=>true,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
	
	<div class="row">
		<?php echo $form->labelEx($model,'login_id'); ?>
		<?php echo $form->textField($model,'login_id',array('size'=>40,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'login_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password',array('value' => '', 'size'=>40,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'password2'); ?>
		<?php echo $form->passwordField($model,'password2',array('value' => '', 'size'=>40,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'password2'); ?>
	</div>
	
	<?php if($model->isNewRecord) : ?>
	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>
	<?php endif; ?>
	
	<div class="row">
		<?php echo $form->labelEx($model,'address'); ?>
		<?php echo $form->textField($model,'address', array('size' => 50)); ?>
		<?php echo $form->error($model,'address'); ?>
	</div>
	
	<?php if(isAdmin()): ?>
	<div class="row">
		<?php echo $form->labelEx($model,'admin'); ?>
		<?php echo $form->checkBox($model,'admin'); ?>
	</div>
	<?php endif; ?>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? '作成' : '更新'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
