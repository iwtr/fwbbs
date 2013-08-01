<?php
class SettingsController extends Controller
{
	public $layout='//layouts/column2';
	
	public function filters()
	{
		return array(
			'accessControl',
			'postOnly + delete'
		);
	}
	
	public function accessRules()
	{
		return array(
				array('allow',
						'actions' => array('index', 'setpager', 'changecolor'),
						'users' => array('@')
				),
				array('allow',
						'actions' => array('setngwords'),
						'expression' => 'isAdmin()'
				),
				
				array('deny',
						'users' => array('*')
				)
		);
	}
	
	public function actionIndex()
	{	
		$this->render('index');
	}
	
	//ページ内表示件数変更
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
	
	//NGワード設定
	public function actionSetNGWords()
	{
		$model = new NGWords();
		
		if(isset($_POST['NGWords']))
		{
			$model->attributes = $_POST['NGWords'];
			
			if($model->save())
			{
				//$this->redirect(array('index'));
			}
			else
			{
				echo 'failed';
			}
		}
		
		if(isset($_POST['del_id']))
		{
			NGWords::model()->findByPk($_POST['del_id'])->delete();
		}
		
		$dataProvider=new CActiveDataProvider('NGWords', array(
				'criteria' => array(
						'order' => 'word ASC'
				),
				'pagination' => false
		));
		
		$this->render('setngwords', array(
				'dataProvider' => $dataProvider,
				'model' => $model
		));
	}
	
	//画面色変更
	public function actionChangeColor()
	{
		$model = $this->loadModel();
		
		if(isset($_POST['yt0']) || isset($_POST['init']))
		{
			$model->color_background = $_POST['color_background'];
			$model->color_page = $_POST['color_page'];
			$model->color_commentbg = $_POST['color_commentbg'];
			if(!$model->save())
			{
				$model->addError('color_background', '入力エラー');
			}
		}
		
		$this->render('changecolor', array(
				'model' => $model
		));
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