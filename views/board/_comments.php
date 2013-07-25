<?php //foreach($datas as $data): ?>
<div class="comment">

	<div class="name">
		<?php echo CHtml::encode(cname($data)); ?>
		<div class="time">
			<?php echo CHtml::encode($data->created_at); ?>
		</div>
	</div>
	
	<div class="content">
		<?php echo nl2br(CHtml::encode($data->contents)); ?>
	</div>
	
	<div class="image">
		<?php if($data->image != NULL): ?>
		<?php echo CHtml::link(CHtml::image('/~iwagaya/fwbbs/images/'.$data->image,'#', array('style' => "max-height:100px; max-width:150px;")), array('/comment/image', 'board' => $data->board_id, 'title' => $data->board->title, 'image' => $data->image)); ?>
		<?php endif; ?>
	</div>
	
	<div class="clear"></div>
	
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