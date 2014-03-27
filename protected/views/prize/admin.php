<?php
/* @var $this PrizeController */
/* @var $model Prize */


$this->breadcrumbs=array(
	'Prizes'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Prize', 'url'=>array('index')),
	array('label'=>'Create Prize', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#prize-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Prizes</h1>

<p>
    The prize and it's quantity on offer on a specified date.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button btn')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'prize-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'desc',
		'offer_date',
		'qty',
		'timestamp',
		'reference',
                //array('claimed'=>$claimed),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>

