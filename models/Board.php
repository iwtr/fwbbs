<?php

/**
 * This is the model class for table "board".
 *
 * The followings are the available columns in table 'board':
 * @property integer $id
 * @property string $title
 * @property string $del_key
 * @property string $created_at
 * @property string $last_updated
 *
 * The followings are the available model relations:
 * @property Comment[] $comments
 */
class Board extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Board the static model class
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
		return 'board';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title', 'required'),
			array('title', 'length', 'max'=>128),
			array('del_key', 'length', 'max'=>4),
			array('last_updated', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, user_id, del_key, created_at, last_updated', 'safe', 'on'=>'search'),
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
				'comments' => array(self::HAS_MANY, 'Comment', 'board_id'),
				'user' => array(self::BELONGS_TO, 'Users', 'user_id'),
				'commentCount' => array(self::STAT, 'Comment', 'board_id')
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => 'タイトル',
			'user_id' => 'ユーザーID',
			'del_key' => '削除キー',
			'created_at' => '作成日時',
			'last_updated' => '最終更新日時',
			'commentCount' => 'コメント数'
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
		
		if($this->user_id != NULL)
		{
			//現在$this->user_idには検索ユーザー名が入っている
			$author = Users::Model()->find('name=:name', array(':name' => $this->user_id));
			//それを正しい値に直す
			$this->user_id = $author->id;
		}
		
		$criteria->compare('id',$this->id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('del_key',$this->del_key,true);
		$criteria->compare('created_at',$this->created_at,true);
		$criteria->compare('last_updated',$this->last_updated,true);

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
				$this->user_id = !Yii::app()->user->isGuest ? Yii::app()->user->id : NULL;
				$this->last_updated = new CDbExpression('NOW()');
				
			}
			return true;
		}
		return false;
	}
}