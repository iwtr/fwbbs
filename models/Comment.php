<?php

/**
 * This is the model class for table "comment".
 *
 * The followings are the available columns in table 'comment':
 * @property integer $id
 * @property integer $board_id
 * @property integer $comnum
 * @property integer $user_id
 * @property string $del_key
 * @property string $pen_name
 * @property string $contents
 * @property string $image
 * @property string $created_at
 *
 * The followings are the available model relations:
 * @property Board $board
 * @property Users $user
 */
class Comment extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Comment the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'comment';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('contents', 'required'),
			array('board_id, user_id', 'numerical', 'integerOnly'=>true),
			array('del_key', 'length', 'max'=>4),
			array('pen_name', 'length', 'max'=>11),
			array('image', 'length', 'max'=>128),
			array('image', 'unique'),
			array('image', 'file', 'types' => 'jpg,jpeg,gif,png,pjpeg', 'maxSize' => 1000000, 'allowEmpty' => true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, board_id, comnum, user_id, del_key, pen_name, contents, image, created_at', 'safe', 'on'=>'search'),
		);
	}
	
	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'board' => array(self::BELONGS_TO, 'Board', 'board_id'),
			'user' => array(self::BELONGS_TO, 'Users', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'board_id' => 'トピックID',
			'comnum' => 'Comnum',
			'user_id' => 'ユーザーID',
			'del_key' => '削除キー',
			'pen_name' => '名前',
			'contents' => '投稿内容',
			'image' => '画像',
			'created_at' => '作成日時',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('board_id',$this->board_id);
		$criteria->compare('comnum',$this->comnum);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('del_key',$this->del_key,true);
		$criteria->compare('pen_name',$this->pen_name,true);
		$criteria->compare('contents',$this->contents,true);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('created_at',$this->created_at,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	protected function beforeSave()
	{
		if(parent::beforeSave())
		{
			if($this->isNewRecord)
			{
				if(empty($this->del_key))
				{
					if($this->del_key != '0')
						$this->del_key = '0000';
				}
				
				$this->user_id = Yii::app()->user->id;
			}
			if(!empty($_FILES['Comment']['name']['image']))
			{
				//既に画像があれば消す
				if($this->image != NULL)
				{
					unlink("images/$this->image");
				}
				
				$info = pathinfo($_FILES['Comment']['name']['image']);
				$this->image = date("ymd",time()).'_'.uniqid(rand(0,100)).'.'.$info['extension'];
			}
			return true;
		}
		return false;
	}
	
	protected function afterSave()
	{
		parent::afterSave();
		
		if(!empty($_FILES['Comment']['name']['image']))
		{
			$file = CUploadedFile::getInstance($this, 'image');
			$file->saveAs(Yii::getPathOfAlias(webroot). '/images/'. $this->image);
		}
		$this->board->last_updated = new CDbExpression('NOW()');
		$this->board->save();
	}
	
}