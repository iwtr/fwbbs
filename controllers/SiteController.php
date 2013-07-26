<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	//トップ画面表示
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		
		/*
		$criteria = new CDbCriteria;
		$criteria->select = 'title, created_at, last_updated';
		$criteria->order = 'last_updated DESC';
		$criteria->limit = 5;
		*/
		//$sql = 'select title, created_at, last_updated from board order by last_updated desc limit 5;';
		//$data = Board::model()->findAllBySql($sql);
		
		$dataProvider = new CActiveDataProvider('Board', array(
				'criteria' => array(
						'select' => 'title, created_at, last_updated',
						'order' => 'last_updated DESC',
						'offset' => 0,
						'limit' => 5,
						'with' => 'commentCount',
				),
				'pagination' => false,
		));
		//$dataProvider->model->
		/*
		$data = Board::model()->with('commentCount')->findAll(array(
				'select' => 'id, title, created_at, last_updated',
				'order' => 'last_updated DESC',
				'limit' => 5,
		));
		*/
		
		//testPrint($dataProvider->model->relations);
		
		$this->render('index', array(
				//'data' => $data,
				'data' => $dataProvider,
		));
	}
	
	

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	/*
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}
	*/
	
	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;
		
		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl); //直前のページにリダイレクト
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
	
	public function actionRoleset()
	{
		
		$auth = Yii::app()->authManager;
		
		$auth->clearAll();
		
		//$auth->createOperation('readComment', 'read a comment');
		//$auth->createOperation('createComment', 'create a comment');
		$auth->createOperation('updateComment', 'update a comment');
		$auth->createOperation('deleteComment', 'delete a comment');
		
		//auth->createOperation('readBoard', 'read a board');
		//$auth->createOperation('createBoard', 'create a board');
		$auth->createOperation('updateBoard', 'update a board');
		$auth->createOperation('deleteBoard', 'delete a board');
		
		$auth->createOperation('readUsers', 'read a users');
		//$auth->createOperation('createUsers', 'create a users');
		$auth->createOperation('updateUsers', 'update a users');
		$auth->createOperation('deleteUsers', 'delete a users');
		
		
		$rule = 'return Yii::app()->user->id==$params["comment"]->user_id;';
		$task = $auth->createTask('updateOwnComment', 'update a comment by author himself', $rule);
		$task->addChild('updateComment');
		$task = $auth->createTask('deleteOwnComment', 'delete a comment by author himself', $rule);
		$task->addChild('deleteComment');
		
		$rule = 'return Yii::app()->user->id == $params["board"]->user_id;';
		$task = $auth->createTask('updateOwnBoard', 'update a board by author himself', $rule);
		$task->addChild('updateBoard');
		$task = $auth->createTask('deleteOwnBoard', 'delete a board by author himself', $rule);
		$task->addChild('deleteBoard');
		
		$rule = 'return Yii::app()->user->id == $params["users"]->id;';
		$task = $auth->createTask('readOwnUsers', 'read a users by author himself', $rule);
		$task->addChild('readUsers');
		$task = $auth->createTask('updateOwnUsers', 'update a users by author himself', $rule);
		$task->addChild('updateUsers');
		$task = $auth->createTask('deleteOwnUsers', 'delete a users by author himself', $rule);
		$task->addChild('deleteUsers');
		
		
		//認証済みユーザーの権限
		$rule = 'return !Yii::app()->user->isGuest;';
		$role = $auth->createRole('user', 'auth user', $rule);
		$role->addChild('updateOwnComment');
		$role->addChild('deleteOwnComment');
		$role->addChild('updateOwnBoard');
		$role->addChild('deleteOwnBoard');
		$role->addChild('readOwnUsers');
		$role->addChild('updateOwnUsers');
		$role->addChild('deleteOwnUsers');
		
		
		//管理者の権限
		$rule = "return isAdmin();";
		$role = $auth->createRole('admin', 'admin user', $rule);
		$role->addChild('user');
		$role->addChild('updateComment');
		$role->addChild('deleteComment');
		$role->addChild('updateBoard');
		$role->addChild('deleteBoard');
		$role->addChild('readUsers');
		$role->addChild('deleteUsers');
		
		$this->redirect('index');
	}
	
}