<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
	
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/color.css" />


	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<?php 
$bg = loadSetting('color_background');
$page = loadSetting('color_page');
?>
	
<?php //echo $bg!=NULL ? 'style="background:'.$bg.';"' : ''; ?>
	
<body id="color_background" >


<div class="container" id="page" <?php echo $page!=NULL ? 'style="background:'.$page.';"' : ''; ?>>

	<div id="header">
		
		<div id="logo"><?php echo CHtml::encode($this->pageTitle); ?></div>
	</div><!-- header -->

	<div id="mainmenu">
		<?php
		$user_id = Yii::app()->user->id;
		$this->widget('zii.widgets.CMenu',array(
			'items'=>array(
					array(
							'label'=>'Home',
							'url'=>array('/site/index'),
					),
					array(
							'label'=>'トピック',
							'url'=>array('/board/index'),
					),
					array(
							'label'=>'コメント管理',
							'url'=>array('/comment/admin'),
							'visible' => isAdmin(),
					),
					array(
							'label'=>'ユーザー管理',
							'url'=>array('/users/admin'),
							'visible' => isAdmin(),
					),
					array(
							'label' => '設定',
							'url' => array('/settings/index'),
							'visible' => !Yii::app()->user->isGuest,
					),
					/*array(
							'label'=>'権限設定の読み込み',
							'url'=>array('/site/roleset'),
							'visible' => isAdmin(),
					),*/
					array(
							'label'=>'ログイン',
							'url'=>array('/site/login'),
							'visible'=>Yii::app()->user->isGuest,
					),
					array(
							'label'=>'ログアウト ('.Yii::app()->user->name.')',
							'url'=>array('/site/logout'),
							'visible'=>!Yii::app()->user->isGuest,
					),
					array(
							'label' => 'ユーザー登録',
							'url' => array('/users/create'),
							'visible' => Yii::app()->user->isGuest,
					),
					array(
							'label' => 'ユーザー情報',
							'url' => array("/users/view/id/$user_id"),
							'visible' => !Yii::app()->user->isGuest,
					)
				//array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about')),
				//array('label'=>'Contact', 'url'=>array('/site/contact')),
			),
		)); ?>
	</div><!-- mainmenu -->
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>
	
	<div>
		<?php echo $content; ?>
	</div>
	
	<div class="clear"></div>
	
	
	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> by My Company.<br/>
		All Rights Reserved.<br/>
		<?php echo Yii::powered(); ?>
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>
