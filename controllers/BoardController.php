<?php

class BoardController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';
	//public $menuattr = array('title' => 'aaa');
	
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
					'actions'=>array('index', 'view', 'create', 'update', 'delete', 'find'),
					'users' => array('*'),
				),
				
				/*
				//本人以外は更新・削除できない
				array('allow',
					'actions'=>array('update'),
					'expression'=>array($this, 'checkupdateBoard'),
				),
				array('allow',
					'actions'=>array('delete'),
					'expression'=>array($this, 'checkdeleteBoard'),
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
	//ユーザーがトピックの作者かどうか
	protected function checkupdateBoard()
	{
		return Yii::app()->user->checkAccess('updateOwnBoard', array('board' =>$this->loadBoard($id)));
	}
	protected function checkdeleteBoard()
	{
		return Yii::app()->user->checkAccess('deleteOwnBoard', array('board' =>$this->loadBoard($id)));
	}
	
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$board = $this->loadBoard();
		
		$comment = new Comment;
		
		$this->performAjaxValidation($comment);
		
		if(isset($_POST['Comment']))
		{
			$comment->attributes = $_POST['Comment'];
			
			if($comment->save())
			{
				$this->redirect(array('board/view','id'=>$comment->board_id));
			}
		}
		
		$dataProvider=new CActiveDataProvider('Comment' ,array(
				'criteria' => array(
						'condition' => "board_id=$board->id",
						'order' => 'created_at DESC',
				),
				'pagination' => array(
						'pageSize' => loadSetting('commentPerPage'),
				),
		));
		
		$this->render('view',array(
				'dataProvider'=>$dataProvider,
				'board' => $board,
				'comment' => $comment,
		));
		
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$board = new Board();
		$comment = new Comment();
		
		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($board);
		
		
		if(isset($_POST['Board']) && isset($_POST['Comment']))
		{
			//$pboard = mysqli_real_escape_string(Yii::app()->db, trim($_POST['Board']));
			//$pcomment = mysqli_real_escape_string(Yii::app()->db, trim($_POST['Comment']));
			$board->attributes = $_POST['Board'];
			$comment->contents = $board->contents;
			$comment->pen_name = $board->pen_name;
			
			if(empty($board->del_key))
			{
				if($board->del_key != '0')
					$board->del_key = '0000';
			}
			
			if($board->save())
			{
				$comment->attributes = $_POST['Comment'];
				$comment->del_key = $board->del_key;
				$comment->board_id = $board->id;
				$comment->save();
				$this->redirect(array('view','id'=>$board->id));
			}
		}
		
		$this->render('create',array(
				//'model'=>$board,
				'board'=>$board,
				'comment'=>$comment,
		));
		
	}
	
	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$board=$this->loadBoard($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($board);
		
		if(isset($_POST['Board']))
		{
			if(Yii::app()->user->checkAccess('updateOwnBoard', array('board' => $board))
							|| $board->del_key === $_POST['Board']['del_key']
							|| isAdmin())
			{
				$board->contents = 'foo'; //入力必須のため代入 保存されるデータとは関係なし
				$board->attributes=$_POST['Board'];
				if($board->save())
					$this->redirect(array('view','id'=>$board->id));
			}
			else
			{
				$board->addError('del_key', '削除キーが間違っています。');
			}
		}
		
		$this->render('update',array(
			'model'=>$board,
		));
		
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$board = $this->loadBoard($id);
		
		
		if(Yii::app()->user->checkAccess('deleteOwnBoard', array('board' => $board)) || isAdmin())
		{
			//内包する画像の削除
			foreach($board->comments as $comment)
			{
				if($comment->image != NULL)
				{
					unlink("images/$comment->image");
				}
			}
			$board->delete();
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
		}
		else if(isset($_POST['Board']['del_key']))
		{
			if($board->del_key === $_POST['Board']['del_key'])
			{
				//内包する画像の削除
				foreach($board->comments as $comment)
				{
					if($comment->image != NULL)
					{
						unlink("images/$comment->image");
					}
				}
				$board->delete();
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
			}
			else
			{
				$board->addError('del_key', '削除キーが間違っています。');
			}
		}
		
		
		$this->render('delete', array('board'=>$board,));
		
		/*
		if(isset($_POST['confirm']))
		{
			if($board->del_key === $_POST['Board']['del_key'])
			{
				$this->setPageState('delete', $_POST['Board']);
				$this->render('confirm', array('board' => $board));
				return;
			}
		}
		$this->render('delete', array('board'=>$board,));
		*/
		
		/*
		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
		*/
	}
	
		/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		Settings::model();
		$board=new Board('search');
		$board->unsetAttributes();
		
		if(isset($_GET['Board']))
		{
			$board->attributes = $_GET['Board'];
		}
		$dataProvider = $board->search();
		$dataProvider->pagination->pageSize = loadSetting('boardPerPage');
		/*
		else
		{
			$dataProvider=new CActiveDataProvider('Board' ,array(
				'pagination' => array(
						'pageSize' => Yii::app()->params['boardsPerPage'],
				),
			));
		}
		*/
		
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
			'board' => $board,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		
		$board=new Board('search');
		$board->unsetAttributes();  // clear any default values
		if(isset($_GET['Board']))
			$board->attributes=$_GET['Board'];
		
		$this->render('admin',array(
			'model'=>$board,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Board the loaded model
	 * @throws CHttpException
	 */

	public function loadBoard()
	{
		if(isset($_GET['id']))
		{
			
			$board=Board::model()->findByPk($_GET['id']);
			if($board===null)
				throw new CHttpException(404,'リクエストされたページは存在しません。');
			return $board;
		}
		else
			throw new CHttpException(404,'リクエストされたページは存在しません。');
	}
	
	/**
	 * Performs the AJAX validation.
	 * @param Board $board the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && ($_POST['ajax']==='board-form' || $_POST['ajax']==='comment-form'))
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
