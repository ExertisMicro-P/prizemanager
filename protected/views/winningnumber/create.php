<?php
/* @var $this WinningNumberController */
/* @var $model WinningNumber */
        $baseUrl = Yii::app()->baseUrl;
  	$cs = Yii::app()->getClientScript();
        $cs->registerScriptFile($baseUrl.'/js/viewscripts/winningnumber.js',CClientScript::POS_END);
        
?>

<?php
$this->breadcrumbs=array(
	'Winning Numbers'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List WinningNumber', 'url'=>array('index')),
	array('label'=>'Create WinningNumber', 'url'=>array('create')),
        array('label'=>'Manage WinningNumber', 'url'=>array('admin')),
);
?>

<h1>Create Winning Numbers </h1>


<?php if($prize){ ?>
<h3> Prize on offer for today is <?php echo $prize->desc ?> </h3>
<p> Number of prizes on offer is <?php echo $prize->qty ?> </p>
<p> Number of invoice number entered so far for this prize <?php echo $entries ?>
<?php   $this->renderPartial('_form', array('model'=>$model, 'prize'=>$prize, 'entries'=>$entries, 'todays_winners'=>$todays_winners));
} 
else{ ?>
    <h3> No action required. There are no prizes available to win today</h3>
<?php }
?>
