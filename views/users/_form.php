<?php
/* @var $this UsersController */
/* @var $model Users */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'users-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
	
	<?php if(!isAdmin() || $_GET['r'] == 'users/create'): ?>
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
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'address'); ?>
		<?php echo $form->textField($model,'address', array('size' => 50)); ?>
		<?php echo $form->error($model,'address'); ?>
	</div>
	<?php endif; ?>
	
	<?php if(isAdmin()): ?>
	<div class="row">
		<?php echo $form->labelEx($model,'admin'); ?>
		<?php echo $form->checkBox($model,'admin'); ?>
	</div>
	<?php endif; ?>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->