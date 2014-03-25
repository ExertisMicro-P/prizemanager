<?php
/* @var $this PrizeController */
/* @var $model Prize */
?>

<?php
$this->breadcrumbs=array(
	'Prizes'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Prize', 'url'=>array('index')),
	array('label'=>'Create Prize', 'url'=>array('create')),
	array('label'=>'Update Prize', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Prize', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Prize', 'url'=>array('admin')),
);
?>

<h1>View Prize #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView',array(
    'htmlOptions' => array(
        'class' => 'table table-striped table-condensed table-hover',
    ),
    'data'=>$model,
    'attributes'=>array(
		'id',
		'desc',
		'offer_date',
		'qty',
		'timestamp',
		'reference',
	),
)); ?>