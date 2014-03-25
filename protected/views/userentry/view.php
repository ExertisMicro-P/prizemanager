<?php
/* @var $this UserEntryController */
/* @var $model UserEntry */
?>

<?php
$this->breadcrumbs=array(
	'User Entries'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List UserEntry', 'url'=>array('index')),
	array('label'=>'Create UserEntry', 'url'=>array('create')),
	array('label'=>'Update UserEntry', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete UserEntry', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage UserEntry', 'url'=>array('admin')),
);
?>

<h1>View UserEntry #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView',array(
    'htmlOptions' => array(
        'class' => 'table table-striped table-condensed table-hover',
    ),
    'data'=>$model,
    'attributes'=>array(
		'id',
		'invoice_no',
		'timestamp',
	),
)); ?>