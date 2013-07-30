<?php
class NGWords extends CActiveRecord
{
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}
	
	public function tableName()
	{
		return 'ngwords';
	}
	
	public function rules()
	{
		return array(
				array('word', 'required'),
				array('word', 'unique'),
		);
	}
	
	public function relation()
	{
		return array(
				'user' => array(self::BELONGS_TO, 'Users', 'user_id')
		);
	}
	
	public function attributeLabels()
	{
		return array(
				'id' => 'ID',
				'user_id' => '作成者ID',
				'word' => 'NGワード'
		);
	}
	
	protected function beforeSave()
	{
		if(parent::beforeSave())
		{
			$this->user_id = Yii::app()->user->id;
			
			return true;
		}
	}
}
