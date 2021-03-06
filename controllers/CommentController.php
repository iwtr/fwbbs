<?php

class CommentController extends Controller
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
					'actions'=>array('view', 'image', 'create', 'update', 'delete'),
					'users' => array('*'),
				),
				/*
				//本人以外更新・削除できない
				array('allow',
					'actions'=>array('update'),
					'expression'=>array($this, 'checkupdateComment'),
				),
				array('allow',
					'actions'=>array('delete'),
					'expression'=>array($this, 'checkdeleteComment'),
				),
				*/
				
				array('allow',
						'actions'=>array('admin'),
						'expression' => 'isAdmin()',
				),
				
				array('deny',
					'users'=>array('*'),
				),
		);
	}
	
	protected function checkupdateComment()
	{	
		return Yii::app()->user->checkAccess('updateOwnComment', array('comment' => $this->loadModel($_GET['id'])));
	}
	protected function checkdeleteComment()
	{
		return Yii::app()->user->checkAccess('deleteOwnComment', array('comment' => $this->loadModel($_GET['id'])));
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}
	
	public function actionImage($board, $title, $image)
	{
		$this->layout = '';
		$this->render('image', array(
				'board' => $board,
				'title' => $title,
				'image' => $image
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		//処理をBoardController側に移動
		/*
		$comment=new Comment;
		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($comment);
		
		if(isset($_POST['Comment']))
		{
			$comment->attributes = $_POST['Comment'];
			
			//$info = pathinfo($_FILES['Comment']['name']['image']);
			//testPrint($info['extension']);
			if($comment->save())
			{
				//$comment->addError('contents', '投稿内容は必須です。');
				
			}
			//$this->redirect(array('board/view','id'=>$comment->board_id));
			
		}
		*/
		
		/*
		$this->render('create',array(
			'model'=>$comment,
		));
		*/
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		
		if(isset($_POST['Comment']))
		{
			if(Yii::app()->user->checkAccess('updateOwnComment', array('comment' => $model))
							|| $model->del_key === $_POST['Comment']['del_key']
							|| isAdmin())
			{
				$model->attributes=$_POST['Comment'];
				if($model->save())
					$this->redirect(array('/board/view','id'=>$model->board->id));
			}
			else
			{
				$model->addError('del_key', '削除キーが間違っています。');
			}
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
	public function actionDelete($id)
	{
		$model = $this->loadModel($id);
		
		if(Yii::app()->user->checkAccess('deleteOwnComment', array('comment' => $model)) || isAdmin())
		{
			if($model->image != NULL)
			{
				unlink("images/$model->image");
			}
			$model->delete();
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('/board/view','id'=>$model->board->id));
		}
		else if(isset($_POST['Comment']['del_key']))
		{
			if($model->del_key === $_POST['Comment']['del_key'])
			{
				if($model->image != NULL)
				{
					unlink("images/$model->image");
				}
				$model->delete();
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('/board/view','id'=>$model->board->id));
			}
			else
			{
				$model->addError('del_key', '削除キーが間違っています。');
			}
		}
		
		
		$this->render('delete', array(
				'model' => $model,
				
		));
		
		/*
		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('/board/view','id'=>$model->board->id));
		*/
	}
	
	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$this->redirect(array('admin'));
		Yii::app()->end();
		
		$dataProvider=new CActiveDataProvider('Comment');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$this->layout='';
		$model=new Comment('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Comment']))
			$model->attributes=$_GET['Comment'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Comment the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Comment::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Comment $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='comment-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
}
