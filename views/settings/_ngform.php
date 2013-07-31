<?php
/*
 * $this SettingsController
 * $model NGWord
 * $form CActiveForm
*/
?>

<div class="form">
	<?php
	$form = $this->beginWidget('CActiveForm', array(
			'id' => 'ngword-form',
			'enableAjaxValidation'=>false,
	));
	echo $form->errorSummary($model);
	?>
	
	<div class="row">
		<?php
		echo $form->labelEx($model, 'word');
		echo $form->textField($model, 'word', array('value' => '', 'size' => 30));
		echo $form->error($model, 'word');
		?>
	</div>
	
	<div class="row buttons">
		<?php echo CHtml::submitButton('追加', array('confirm' => '本当に追加しますか？')); ?>
	</div>
	
	<?php $this->endWidget(); ?>
	
</div>