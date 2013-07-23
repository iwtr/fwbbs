<?php
/* @var $this CommentController */
/* @var $comment Comment */
/* @var $form CActiveForm */
?>

<div class="form">

<?php
$id = $_GET['id'];
$action = ($_GET['r']=='board/view') ? array('comment/create') : array("comment/update&id=$id"); 
$form=$this->beginWidget('CActiveForm', array(
		'action' => $action,
		'id'=>'comment-form',
		'htmlOptions' => array('enctype' => 'multipart/form-data'),
		'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($comment); ?>

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
	
	<?php if($comment->image != NULL): ?>
	<div class="row">
		<?php echo $form->labelEx($comment,'画像を削除'); ?>
		<?php echo $form->checkBox($comment,'image'); ?>
	</div>
	<?php endif; ?>
	
	<?php if(!Yii::app()->user->checkAccess('updateOwnComment', array('comment' => $comment))): ?>
	<div class="row">
		<?php echo $form->labelEx($comment,'del_key'); ?>
		<?php echo $form->textField($comment,'del_key',array('value'=>'', 'size'=>4,'maxlength'=>4)); ?>
		<?php echo $form->error($comment,'del_key'); ?>
	</div>
	<?php endif; ?>
	
	<?php echo $form->hiddenField($comment, 'board_id', array('value'=>$board_id));?>
	<?php echo $form->error($comment, 'board_id'); ?>
	
	<div class="row buttons">
		<?php echo CHtml::submitButton($comment->isNewRecord ? '作成' : '更新',
						$comment->isNewRecord ? array() : array('confirm'=>'本当に更新しますか？')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->