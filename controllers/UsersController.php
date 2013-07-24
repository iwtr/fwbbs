<?php

class UsersController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',
					'actions'=>array('create'),
					'users'=>array('*'),
			),
			array('allow',
					'actions' => array('view'),
					'expression' => array($this, 'checkUpdateUsers'),
			),
			array('allow',
					'actions' => array('update'),
					'expression' => array($this, 'checkUpdateUsers'),
			),
			array('allow',
					'actions' => array('delete'),
					'expression' => array($this, 'checkDeleteUsers'),
			),
			array('allow',
					'actions' => array('admin', 'view', 'index', 'update', 'delete'),
					'expression' => 'isAdmin()',
			),
				
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	
	protected function checkUpdateUsers()
	{
		return Yii::app()->user->checkAccess('updateOwnUsers', array('users' => $this->loadModel()));
	}
	protected function checkDeleteUsers()
	{
		return Yii::app()->user->checkAccess('deleteOwnUsers', array('users' => $this->loadModel()));
	}

		/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView()
	{
		$this->render('view',array(
			'model'=>$this->loadModel(),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Users;
		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		
		if(isset($_POST['Users']))
		{
			$model->attributes=$_POST['Users'];
			if($model->save())
			{
				$this->redirect(Yii::app()->user->returnUrl);
			}
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate()
	{
		$model=$this->loadModel();
		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Users']))
		{
			$model->attributes=$_POST['Users'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete()
	{
		$this->loadModel()->delete();
		
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		/*
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		*/
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Users');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Users('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Users']))
			$model->attributes=$_GET['Users'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Users the loaded model
	 * @throws CHttpException
	 */
	public function loadModel()
	{
		if(isset($_GET['id']))
		{
			$model=Users::model()->findByPk($_GET['id']);
			if($model===null)
				throw new CHttpException(404,'リクエストされたページは存在しません。');
			return $model;
		}
		else
			throw new CHttpException(404,'リクエストされたページは存在しません。');
	}

	/**
	 * Performs the AJAX validation.
	 * @param Users $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='users-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
