<?php

$this->breadcrumbs=array(
		'トピック一覧'=>array('/board/index'),
		$title => array('/board/view', 'id' => $board),
		$image
);
?>

<div id="test" style="text-align: center;">
	<?php
	echo CHtml::image('/~iwagaya/fwbbs/images/'.$image, '#', array('id' => 'image'));
	?>
</div>

