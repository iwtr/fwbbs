<?php

class WebUser extends CWebUser
{
	
	public function getIsAdmin()
	{
		
		if($this->isGuest)
		{
			return false;
		}
		$user = is_null(Users::model()->findByAttributes(array('name' => Yii::app()->user->name, 'admin' => true)));
		//$user = Users::model()->findByAttributes(array('name' => Yii::app()->user->name, 'admin' => true));
		return !$user;
		//return $user && $user->isAdmin;
	}
}

?>