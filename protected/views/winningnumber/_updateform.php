<?php
/* @var $this WinningNumberController */
/* @var $model WinningNumber */
/* @var $form TbActiveForm */
?>

<div class="form">

    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'winning-number-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>
   
    <?php echo $form->errorSummary($model); ?>
        <?php echo $form->textFieldControlGroup($model,'id',array('span'=>5,'maxlength'=>50, 'readonly'=>'readonly')); ?>
        <?php echo $form->textFieldControlGroup($model,'invoice_no',array('span'=>5,'maxlength'=>8,'size'=>50, 'class'=>'invoice-no')); ?>
         <?php echo '<span id="WinningNumber_invoice_no_error" class="error"></span>'; ?>
        <?php echo $form->textFieldControlGroup($model,'prize_id',array('span'=>5,'maxlength'=>50, 'readonly'=>'readonly')); ?>
        <?php echo $form->textFieldControlGroup($model,'claimed',array('span'=>5,'maxlength'=>50, 'readonly'=>'readonly')); ?>

        <p class="help-block">Fields with <span class="required">*</span> are required.</p>
            <div class="form-actions">
            <?php 
            
            if($model->claimed != WinningNumber::CLAIMED ){echo TbHtml::submitButton('Update',array(
                        'color'=>TbHtml::BUTTON_COLOR_PRIMARY,
                        'size'=>TbHtml::BUTTON_SIZE_LARGE,
            ));} ?>
            </div>
 <?php $this->endWidget(); ?>
       
   
    
</div><!-- form -->
