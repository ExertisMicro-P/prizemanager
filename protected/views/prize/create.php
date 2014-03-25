<?php
/* @var $this PrizeController */
/* @var $model Prize */
        $baseUrl = Yii::app()->baseUrl;
  	$cs = Yii::app()->getClientScript();
        Yii::app()->clientScript->registerCoreScript('jquery.ui');
        $cs->registerScriptFile($baseUrl.'/js/viewscripts/prize.js',CClientScript::POS_END);
?>

<?php
$this->breadcrumbs=array(
	'Prizes'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Prize', 'url'=>array('index')),
	array('label'=>'Manage Prize', 'url'=>array('admin')),
);
?>

<h1>Create Prize</h1>

<?php $this->renderPartial('_form', array('model'=>$model,'dates'=>$dates)); ?>