<?php
/* @var $this WinningNumberController */
/* @var $model WinningNumber */


$this->breadcrumbs=array(
	'Winning Numbers'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List WinningNumber', 'url'=>array('index')),
	array('label'=>'Create WinningNumber', 'url'=>array('create')),
        array('label'=>'Manager WinningNumber', 'url'=>array('list')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#winning-number-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Winning Numbers</h1>

<p>Numbers which correspond to a prize. </p>
<p>If a participant enters one of these number they win the corresponding prize.
</p>

<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'winning-number-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'invoice_no',
		'prize_id',
		'claimed',
		'timestamp',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>