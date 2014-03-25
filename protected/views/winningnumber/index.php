<?php
/* @var $this WinningNumberController */
/* @var $dataProvider CActiveDataProvider */
?>

<?php
$this->breadcrumbs=array(
	'Winning Numbers',
);

$this->menu=array(
	array('label'=>'Create WinningNumber','url'=>array('create')),
	array('label'=>'Manage WinningNumber','url'=>array('admin')),
);
?>

<h1>Winning Numbers</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>