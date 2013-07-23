<?php
// using Yii::app()->params['paramName']
return array(
		// this is displayed in the header section
		'title'=>'framework bbs',
		// this is used in error pages
		'adminEmail'=>'iwagaya@staff-info.co.jp',
		// number of displayed per page
		'boardsPerPage' => 6,
		'commentsPerPage' => 5,
		// maximum number of comments that can be displayed in recent comments portlet
		'recentCommentCount'=>10,
		// maximum number of tags that can be displayed in tag cloud portlet
		'tagCloudCount'=>20,
		// whether post comments need to be approved before published
		'commentNeedApproval'=>false,
		// the copyright information displayed in the footer section
		'copyrightInfo'=>'Copyright &copy; 2013 by staff.',
);
