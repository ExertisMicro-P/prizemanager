<?php
/* @var $this PrizeController */
/* @var $dataProvider CActiveDataProvider */
?>

<?php
$this->breadcrumbs=array(
	'Prizes',
);

$this->menu=array(
	array('label'=>'Create Prize','url'=>array('create')),
	array('label'=>'Manage Prize','url'=>array('admin')),
);
?>

<h1>Prizes</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>