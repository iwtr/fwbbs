<div style="position: relative; left: -3px;">
<?php
$data = Users::Model()->findByPk(Yii::app()->user->id);

$this->widget('zii.widgets.CDetailView', array(
		'data' => $data,
		'attributes' => array(
				'id',
				'name',
				'address',
				'admin',
				array('name' => '作成トピック数', 'value' => count($data->boards)),
				array('name' => '総コメント数', 'value' => count($data->comments))
		),
));
?>
</div>
