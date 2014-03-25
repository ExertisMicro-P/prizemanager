<?php
/* @var $this PrizeController */
/* @var $model Prize */
/* @var $form CActiveForm */
?>

<div class="wide form">

    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

                    <?php echo $form->textFieldControlGroup($model,'id',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'desc',array('span'=>5,'maxlength'=>200)); ?>

                    <?php echo $form->textFieldControlGroup($model,'offer_date',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'qty',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'timestamp',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'reference',array('span'=>5,'maxlength'=>50)); ?>

        <div class="form-actions">
        <?php echo TbHtml::submitButton('Search',  array('color' => TbHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->