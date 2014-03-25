<?php
/* @var $this PrizeController */
/* @var $model Prize */
?>

<?php
$this->breadcrumbs=array(
	'Prizes'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Prize', 'url'=>array('index')),
	array('label'=>'Create Prize', 'url'=>array('create')),
	array('label'=>'View Prize', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Prize', 'url'=>array('admin')),
);
?>

    <h1>Update Prize <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>