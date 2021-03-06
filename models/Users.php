<?php

/**
 * This is the model class for table "users".
 *
 * The followings are the available columns in table 'users':
 * @property integer $id
 * @property string $login_id
 * @property string $password
 * @property string $name
 * @property string $address
 * @property integer $admin
 *
 * The followings are the available model relations:
 * @property Comment[] $comments
 */
class Users extends CActiveRecord
{
	public $password2;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Users the static model class
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
		return 'users';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('login_id, password, password2, name, address', 'required'),
			array('address', 'email'),
			array('admin', 'numerical', 'integerOnly'=>true),
			array('login_id, password', 'length', 'max'=>50),
			array('password2', 'compare', 'compareAttribute'=>'password'),
			array('name', 'length', 'max'=>20),
			array('name', 'unique'),
			array('name', 'match', 'pattern' => '/^[^¥[].*[^¥]]?$/',//[名前]のパターンを除外
					'message' => '名前の両端に[]は使用できません'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, login_id, password, name, address, admin', 'safe', 'on'=>'search'),
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
			'comments' => array(self::HAS_MANY, 'Comment', 'user_id'),
			'boards' => array(self::HAS_MANY, 'Board', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'login_id' => 'id',
			'password' => 'パスワード',
			'password2' => 'パスワード(確認)',
			'name' => '名前',
			'address' => 'メールアドレス',
			'admin' => 'Admin',
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
		$criteria->compare('login_id',$this->login_id,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('admin',$this->admin);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function validatePassword($password)
	{
		return sha1($password) === $this->password;
	}
	
	public function hashpassword($password)
	{
		return $password;
	}
	
	protected function beforeSave()
	{
		if(parent::beforeSave())
		{
			$this->password = sha1($this->password);
			return true;
		}
		return false;
	}
	protected function afterSave()
	{
		parent::afterSave();
		
		
		
		if(Yii::app()->user->isGuest)
		{
			$loginform = new LoginForm;

			$loginform->login_id = $this->login_id;
			$loginform->password = $_POST['Users']['password'];

			$loginform->login();
		}
	}
	
}