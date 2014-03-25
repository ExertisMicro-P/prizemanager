<?php
/* @var $this UserEntryController */
/* @var $model UserEntry */
?>

<?php
$this->breadcrumbs=array(
	'User Entries'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List UserEntry', 'url'=>array('index')),
	array('label'=>'Manage UserEntry', 'url'=>array('admin')),
);
?>

<h1>Create UserEntry</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>