<?php
/* @var $this PrizeController */
/* @var $model Prize */
/* @var $form TbActiveForm */

?>

<div class="form">

    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'prize-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

    <p class="help-block">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

            <?php echo $form->textFieldControlGroup($model,'desc',array('span'=>5,'maxlength'=>200)); ?>

            <label class="control-label" for="offer_date">Date when offer becomes active</label>
            <?php //echo $form->dateField($model, 'offer_date', array('class'=>'date-picker')) ?>
           <input name="start_date" id="start_date" value="<?php echo $model->offer_date  ?>" class="date-picker" />
            <?php echo $form->hiddenField($model, 'offer_date',array('id' => 'offer_date')) ?>

            <?php echo $form->textFieldControlGroup($model,'qty',array('span'=>5)); ?>

            <?php echo $form->textFieldControlGroup($model,'reference',array('span'=>5,'maxlength'=>50)); ?>

        <div class="form-actions">
        <?php echo TbHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array(
		    'color'=>TbHtml::BUTTON_COLOR_PRIMARY,
		    'size'=>TbHtml::BUTTON_SIZE_LARGE,
		)); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->

    <?php //create js unavailable dates
    $str = '["';
    $str .= implode('","', $dates);
    $str .= '"]';
    //add to object. These will get used by prize.js
   
    echo '<script> var PrizeDates = {
        unavailable: ' .$str . 
        '}</script>'
  
?>
