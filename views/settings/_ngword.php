
<div class="row">
	<div class="word">
		<?php echo CHtml::encode($data->word); ?>
	</div>

	<div class="deletebtn">
		<?php 
		echo CHtml::link('削除', '#', array(
				'submit' => array('setngwords'),
				'params' => array('del_id' => $data->id),
				'confirm'=>'本当に削除しますか？'
		));
		?>
	</div>
</div>