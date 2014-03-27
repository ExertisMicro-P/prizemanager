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
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List WinningNumber', 'url'=>array('index')),
	array('label'=>'Create WinningNumber', 'url'=>array('create')),
	array('label'=>'View WinningNumber', 'url'=>array('view', 'id'=>$model->id)),
        array('label'=>'Manager WinningNumber', 'url'=>array('list')),
);
?>

<?php //can't update this if someone has claimed the prize
        if($model->claimed == WinningNumber::CLAIMED){
            echo '<h2 class="error" >Sorry this prize has been claimed and can not be updated</h2>'; 
            $this->renderPartial('_updateview', array('model'=>$model));
        }else{ ?>
            <h1>Update winning number for prize : <?php echo $prize->desc?></h1>
          
        <?php  $this->renderPartial('_updateform', array('model'=>$model));
        }
?>
