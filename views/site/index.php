<?php
$this->pageTitle = Yii::app()->name;

?>

<h2 style="margin-bottom: 0;">書き込みがあったトピック(最新５件)</h2>

<?php /*foreach($data as $value): ?>
	<div class="updates">
		<div class="title">
			<?php echo CHtml::link(CHtml::encode($value->title), array('/board/view', 'id'=>$value->id)); ?>
		</div>
		<div class="last_updated">
			<?php echo CHtml::encode($value->last_updated); ?>
		</div>
		<div class="count">
			<?php echo CHtml::encode($value->commentCount); ?>
		</div>
	</div>
<?php endforeach;
*/ ?>

<div style="display: inline-block;">
<?
$this->widget('zii.widgets.grid.CGridView', array(
		'id' => 'update-grid',
		'dataProvider' => $data,
		'ajaxUpdate' => false,
		'selectableRows' => 0,
		'enablePagination' => false,
		'enableSorting' => false,
		'summaryText' => '',
		'columns' => array(
				'title',
				'created_at',
				'last_updated',
				'commentCount'
		),
));
?>
</div>
