<?php
/* @var $this BoardController */
/* @var $board Board */
/* @var $form CActiveForm */

?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'board-form',
	'htmlOptions' => array('enctype' => 'multipart/form-data'),
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note"><span class="required">*</span>のある項目は入力必須です。</p>

	<?php 
	if(isset($comment))
	{
		echo $form->errorSummary(array($board, $comment), false);
	}
	else
	{
		echo $form->errorSummary($board);
	}
	?>

	<div class="row">
		<?php echo $form->labelEx($board,'title'); ?>
		<?php echo $form->textField($board,'title',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($board,'title'); ?>
	</div>
	
	<?php if(isset($comment)) : ?>
	<div class="row" style="visibility:<?php echo Yii::app()->user->isGuest ? 'visible':'hidden'; ?>;">
		<?php echo $form->labelEx($comment,'pen_name'); ?>
		<?php echo $form->textField($comment,'pen_name',array('size'=>11,'maxlength'=>11)); ?>
		<?php echo $form->error($comment,'pen_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($comment,'contents'); ?>
		<?php echo $form->textArea($comment,'contents',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($comment,'contents'); ?>
	</div>
	
	<div class="row">
		
		<?php echo $form->labelEx($comment,'image', array('label'=>'画像(jpg,jpeg,gif,png)')); ?>
		<?php echo $form->fileField($comment,'image'); ?>
		<?php echo $form->error($comment,'image'); ?>
	</div>
	<?php endif; ?>
	
	<?php 
	//新規作成か作者以外が更新する場合は表示
	if(!isAdmin()||$board->isNewRecord): if(!Yii::app()->user->checkAccess('updateOwnBoard', array('board' => $board))) : 
	?>
	<div class="row">
		<?php echo $form->labelEx($board,'del_key'); ?>
		<?php echo $form->textField($board,'del_key',array('value'=>'', 'size'=>4,'maxlength'=>4)); ?>
		<?php echo $board->isNewRecord ? '入力がない場合は0000になります。' : ''; ?>
		<?php echo $form->error($board,'del_key'); ?>
	</div>
	<?php endif;endif; ?>

	<div class="row buttons">
		<?php echo CHtml::submitButton($board->isNewRecord ? '作成' : '更新',
						$board->isNewRecord ? array() : array('confirm'=>'本当に更新しますか？') ); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->