<?php

$this->breadcrumbs=array(
		'トピック一覧'=>array('/board/index'),
		$title => array('/board/view', 'id' => $board),
		$image
);
?>
<div style="text-align: center;">
	<?php
	echo CHtml::image('/~iwagaya/fwbbs/images/'.$image, '#');
	?>
</div>
