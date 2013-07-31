<?php
function isAdmin()
{
	return Yii::app()->user->getIsAdmin();
}

function testPrint($item)
{
	echo '<pre>';
	var_dump($item);
	//print_r($item);
	echo '</pre>';
}

function cname($item)
{
	if(!empty($item->user->name))
	{
		$name = '['.$item->user->name.']';
	}
	else
	{
		if(!empty($item->pen_name))
		{
			$name = $item->pen_name;
		}
		else
		{
			$name = '名無し';
		}
	}
	return $name;
}

function hide_ngword($item)
{
	$ngwords = NGWords::model()->findAll();
	
	foreach ($ngwords as $ngword)
	{
		$item = str_replace($ngword->attributes, '<span style="color:red">***</span>', $item);
	}
	
	return $item;
}

function loadSetting($columnname)
{
	if(!Yii::app()->user->isGuest)
	{
		$setting = Settings::model()->findByAttributes(array('user_id' => Yii::app()->user->id))->$columnname;
		return $setting;
	}
	return;
}

?>
