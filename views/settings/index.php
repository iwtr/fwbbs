<?php
$this->breadcrumbs = array(
		'設定'
);
?>

<h2>各種設定を行います。</h2>

<?php
$this->widget('zii.widgets.CMenu', array(
		'htmlOptions'=>array('class'=>'settingmenu'),//main.css
		'items' => array(
				array('label' => 'ページ毎表示件数変更', 'url' => array('setpager')),
				array('label' => 'foo'),
				array('label' => 'bar')
		)		
));
