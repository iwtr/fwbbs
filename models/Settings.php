<?php
class Settings extends CActiveRecord
{
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}
	
	public function tableName()
	{
		return 'settings';
	}
	
	public function rules()
	{
		return array(
				array('boardPerPage, commentPerPage', 'required'),
				array('boardPerPage, commentPerPage', 'numerical', 'min' => 1, 'max' => 100),
				
		);
	}
	
	public function relations()
	{
		return array(
				'user' => array(self::BELONGS_TO, 'Users', 'user_id')
		);
	}
	
	public function attributeLabels()
	{
		return array(
				'id' => 'ID',
				'user_id' => 'id',
				'boardPerPage' => 'トピック最大表示数',
				'commentPerPage' => 'コメント最大表示数',
				'color_background' => '背景色',
				'color_page' => 'ページ色',
				'color_commentbg' => 'コメント背景',
		);
	}
	
}