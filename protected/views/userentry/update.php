<?php
/* @var $this UserEntryController */
/* @var $model UserEntry */
?>

<?php
$this->breadcrumbs=array(
	'User Entries'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List UserEntry', 'url'=>array('index')),
	array('label'=>'View UserEntry', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage UserEntry', 'url'=>array('admin')),
);
?>

    <h1>Update UserEntry <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>