<?php
/* @var $this CommentController */
/* @var $data Comment */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('board_id')); ?>:</b>
	<?php echo CHtml::encode($data->board_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
	<?php echo CHtml::encode($data->user_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('del_key')); ?>:</b>
	<?php echo CHtml::encode($data->del_key); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pen_name')); ?>:</b>
	<?php echo CHtml::encode($data->pen_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('contents')); ?>:</b>
	<?php echo CHtml::encode($data->contents); ?>
	<br />
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('image')); ?>:</b>
	<?php echo CHtml::image('/~iwagaya/fwbbs/images/'.$data->image,'#'); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created_at')); ?>:</b>
	<?php echo CHtml::encode($data->created_at); ?>
	<br />

</div>