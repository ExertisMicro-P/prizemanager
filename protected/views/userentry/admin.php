<?php
/* @var $this UserEntryController */
/* @var $model UserEntry */


$this->breadcrumbs=array(
	'User Entries'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List UserEntry', 'url'=>array('index')),
	array('label'=>'Create UserEntry', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#user-entry-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage User Entries</h1>

<p>
    All numbers entered by the user during the promotion offer.
</p>

<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'user-entry-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'invoice_no',
		'timestamp',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>