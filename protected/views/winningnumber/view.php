<?php
/* @var $this WinningNumberController */
/* @var $model WinningNumber */
?>

<?php
$this->breadcrumbs=array(
	'Winning Numbers'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List WinningNumber', 'url'=>array('index')),
	array('label'=>'Create WinningNumber', 'url'=>array('create')),
	array('label'=>'Update WinningNumber', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete WinningNumber', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage WinningNumber', 'url'=>array('admin')),
);
?>

<h1>View WinningNumber #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView',array(
    'htmlOptions' => array(
        'class' => 'table table-striped table-condensed table-hover',
    ),
    'data'=>$model,
    'attributes'=>array(
		'id',
		'invoice_no',
		'prize_id',
		'claimed',
		'timestamp',
	),
)); ?>