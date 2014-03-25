<?php
/* @var $this UserEntryController */
/* @var $dataProvider CActiveDataProvider */
?>

<?php
$this->breadcrumbs=array(
	'User Entries',
);

$this->menu=array(
	array('label'=>'Create UserEntry','url'=>array('create')),
	array('label'=>'Manage UserEntry','url'=>array('admin')),
);
?>

<h1>User Entries</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>