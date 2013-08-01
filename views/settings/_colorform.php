<?php
/*
 * $this SettingsController
 * $model Settings
 * $form CActiveForm
 */
?>

<div class="form">
	<?php
	$form = $this->beginWidget('CActiveForm', array(
			'id' => 'color-form',
			'enableAjaxValidation' => false
	));
	echo $form->errorSummary($model);
	?>
	
	<div class="row">
		<?php
		$current = "'".$model->color_background."'";
		echo $form->labelEx($model, 'color_background');
		echo "<input type='color' name='color_background' value=$current>";
		echo $form->error($model, 'color_background');
		?>
	</div>
	
	<div class="row">
		<?php
		$current = "'".$model->color_page."'";
		echo $form->labelEx($model, 'color_page');
		echo "<input type='color' name='color_page' value=$current>";
		echo $form->error($model, 'color_page');
		?>
	</div>
	
	<div class="row">
		<?php
		$current = "'".$model->color_commentbg."'";
		echo $form->labelEx($model, 'color_commentbg');
		echo "<input type='color' name='color_commentbg' value=$current>";
		echo $form->error($model, 'color_commentbg');
		?>
	</div>
	
	<div class="row buttons">
		<?php echo CHtml::submitButton('変更'); ?>
	</div>
	
	<?php $this->endwidget(); ?>
	
	<div>
		<?php echo CHtml::submitButton('デフォルトに戻す', array(
				'confirm' => '設定を初期化します。よろしいですか？',
				'submit' => array('changecolor'),
				'params' => array(
						'init' => 'init',
						'color_background' => NULL,
						'color_page' => NULL,
						'color_commentbg' => NULL
				),
		)); ?>
	</div>
	
</div>
