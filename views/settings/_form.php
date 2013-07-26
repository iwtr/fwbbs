<?php
/*
 * $this SettingController
 * $model Settings
 * $form CActiveForm
*/
?>

<div class="form">
	<?php
	$form = $this->beginWidget('CActiveForm', array(
			'id' => 'setting-form',
			'enableAjaxValidation'=>false,
	));
	
	echo $form->errorSummary($model);
	
	echo '<div class="row">';
		echo $form->labelEX($model, 'boardPerPage');
		echo $form->textField($model, 'boardPerPage');
		echo $form->error($model, 'boardPerPage');
	echo '</div>';
	
	echo '<div class="row">';
		echo $form->labelEX($model, 'commentPerPage');
		echo $form->textField($model, 'commentPerPage');
		echo $form->error($model, 'commentPerPage');
	echo '</div>';
	
	echo '<div class="row buttons">';
		echo CHtml::submitButton('更新', array('confirm'=>'本当に更新しますか？'));
	echo '</div>';
	
	$this->endWidget();
	?>
</div>
