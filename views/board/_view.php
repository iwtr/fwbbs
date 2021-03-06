<?php
/* @var $this BoardController */
/* @var $data Board */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('title')); ?>:</b>
	<?php echo CHtml::link(hide_ngword(CHtml::encode($data->title)), array('view', 'id'=>$data->id), array('style' => 'font-size: 20px; text-decoration: none;')); ?>
	<br />
	
	<b><?php echo '作者'; ?>:</b>
	<?php echo CHtml::encode(cname($data)); ?>
	<br />
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('created_at')); ?>:</b>
	<?php echo CHtml::encode($data->created_at); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('last_updated')); ?>:</b>
	<?php echo CHtml::encode($data->last_updated); ?>
	<br />


</div>