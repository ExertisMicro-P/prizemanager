<?php
/* @var $this WinningNumberController */
/* @var $model WinningNumber */
?>

<?php
$this->breadcrumbs=array(
	'Winning Numbers'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List WinningNumber', 'url'=>array('index')),
	array('label'=>'Create WinningNumber', 'url'=>array('create')),
	array('label'=>'View WinningNumber', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage WinningNumber', 'url'=>array('admin')),
);
?>

    <h1>Update WinningNumber <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>