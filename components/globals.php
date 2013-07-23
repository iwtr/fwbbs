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
		$name = $item->user->name;
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

?>
