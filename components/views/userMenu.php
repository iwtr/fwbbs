<div>
<?php
$data = Users::Model()->findByPk(Yii::app()->user->id);
$admin = isAdmin() ? '○' : '×';

$this->widget('zii.widgets.CDetailView', array(
		'data' => $data,
		//'htmlOptions' => array('class' => 'detail'),
		'attributes' => array(
				'id',
				'name',
				//'address',
				array('name' => 'admin', 'value' => $admin),
				array('name' => '作成トピック数', 'value' => count($data->boards)),
				array('name' => '総コメント数', 'value' => count($data->comments))
		),
));
?>
</div>
