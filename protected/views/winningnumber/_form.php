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
    <?php $qty = $prize->qty - $entries ?>
    <?php echo $form->errorSummary($model); ?>
    <?php if($qty >0){ ?>
        <div class="control-group">
                <?php for($i=1; $i < $qty+1; $i++){
                    echo '<label class="control-label" for="invoice">Invoice ' . $i . '</label>';
                    echo $form->textField($model,'['.$i.']invoice_no',array('size'=>80,'maxlength'=>8, 'class'=>'controls invoice-input' ,'data-id'=>$i));
                    echo '<span id="WinningNumber_' . $i . '_invoice_no_error" class="error"></span>';
                }
         ?>
        </div>
        <input type='hidden' name='prize_id' value='<?php echo $prize->id ?>'>
        <p class="help-block">Fields with <span class="required">*</span> are required.</p>
            <div class="form-actions">
            <?php echo TbHtml::submitButton('Create',array(
                        'color'=>TbHtml::BUTTON_COLOR_PRIMARY,
                        'size'=>TbHtml::BUTTON_SIZE_LARGE,
                    )); ?>
        </div>
         <?php }  // if qty > 0 ?>
 <?php $this->endWidget(); ?>



</div><!-- form -->
<p>Invoice numbers already entered for the prize on offer today</p>
<?php
//add table of entered numbers
    $this->widget('zii.widgets.grid.CGridView', array(

				'id'=>'todays-winners',
                                'dataProvider'=>$todays_winners,
                                'columns'=>array(
                                       'invoice_no',
                                    ),
				'emptyText' => 'No Invoice Numbers Entered!'

		));
    ?>
