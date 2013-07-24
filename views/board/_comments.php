<?php //foreach($datas as $data): ?>
<div class="comment">

	<?php
	//testPrint($data->attributes);
	?>

	<div class="name">
		<?php echo CHtml::encode(cname($data)); ?>
	</div>
	
	<div class="time">
		<?php echo CHtml::encode($data->created_at); ?>
	</div>
	
	<div class="content">
		<?php echo nl2br(CHtml::encode($data->contents)); ?>
	</div>
	
	<?php if($data->image != NULL): ?>
	<div class="image">
		<?php echo CHtml::image('/~iwagaya/fwbbs/images/'.$data->image,'#', array('style' => "max-height:150px; max-width:200px;")); ?>
	</div>
	<?php endif; ?>
	
	<div style="text-align: right;">
		<?php echo CHtml::link('更新', array('comment/update', 'id'=>$data->id)); ?>
		<?php
		$linkoption = Yii::app()->user->checkAccess('deleteOwnComment', array('comment' => $data))||isAdmin() ?
						array('submit'=>array('/comment/delete','id'=>$data->id),'confirm'=>'本当によろしいですか？') :
						array('submit'=>array('/comment/delete','id'=>$data->id));
		echo CHtml::link('削除', '#', $linkoption);
		?>
	</div>

</div><!-- comment -->
<?php //endforeach; ?>