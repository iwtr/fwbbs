<?php
class SettingsController extends Controller
{
	public $layout='//layouts/column2';
	
	public function accessRules()
	{
		return array(
				array('allow',
						'actions' => array('index', 'setpager',),
						'users' => '@'
				),
				array('arrow',
						'actions' => array(),
						'expression' => 'isAdmin()'
				),
				
				array('deny',
						'users' => '*'
				)
		);
	}
	
	public function actionIndex()
	{
		$this->render('index', array('user_id' => Yii::app()->user->id));
	}
	
	public function actionSetPager()
	{
		$model = $this->loadModel();
		
		if(isset($_POST['Settings']))
		{
			$model->attributes = $_POST['Settings'];
			if($model->save())
			{
				$this->redirect(array('index'));
			}
		}
		$this->render('setpager', array('model' => $model));
	}
	
	public function loadModel()
	{
		$model = Settings::model()->find('user_id=:user_id', array(':user_id' => Yii::app()->user->id));
		if($model===null)
		{
			throw new CHttpException(404,'ページが存在しません。');
		}
		return $model;
	}
}