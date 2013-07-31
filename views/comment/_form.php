<?php
/* @var $this CommentController */
/* @var $comment Comment */
/* @var $form CActiveForm */
?>

<div class="form">

<?php
$properties = $_GET['r']=='comment/update' ?
				array(
						'id'=>'comment-form',
						'focus' => array($comment, 'contents'),
						'htmlOptions' => array('enctype' => 'multipart/form-data'),
						'enableAjaxValidation'=>true
				) :
				array(
						'id'=>'comment-form',
						'htmlOptions' => array('enctype' => 'multipart/form-data'),
						'enableAjaxValidation'=>true
				);

$form=$this->beginWidget('CActiveForm', $properties); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>
	
	<?php echo $form->errorSummary($comment); ?>
	
	<?php if(Yii::app()->user->isGuest) : ?>
	<div class="row">
		<?php echo $form->labelEx($comment,'pen_name'); ?>
		<?php echo $form->textField($comment,'pen_name',array('size'=>11,'maxlength'=>11, 'placeholder' => '名無し')); ?>
		<?php echo $form->error($comment,'pen_name'); ?>
	</div>
	<?php endif; ?>
	
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
	
	<?php if(!isAdmin()||$comment->isNewRecord): if(!Yii::app()->user->checkAccess('updateOwnComment', array('comment' => $comment))): ?>
	<div class="row">
		<?php echo $form->labelEx($comment,'del_key'); ?>
		<?php echo $form->textField($comment,'del_key', array('value'=>'','size'=>4,'maxlength'=>4)); ?>
		<?php echo $comment->isNewRecord ? '入力がない場合は0000になります。' : ''; ?>
		<?php echo $form->error($comment,'del_key'); ?>
	</div>
	<?php endif;endif; ?>
	
	<?php echo $form->hiddenField($comment, 'board_id', array('value'=>$board_id));?>
	<?php echo $form->error($comment, 'board_id'); ?>
	
	<div class="row buttons">
		<?php echo CHtml::submitButton($comment->isNewRecord ? '作成' : '更新',
						$comment->isNewRecord ? array() : array('confirm'=>'本当に更新しますか？')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->