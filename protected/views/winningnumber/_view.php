<?php
/* @var $this WinningNumberController */
/* @var $data WinningNumber */
?>

<div class="view">

    	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('invoice_no')); ?>:</b>
	<?php echo CHtml::encode($data->invoice_no); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('prize_id')); ?>:</b>
	<?php echo CHtml::encode($data->prize_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('claimed')); ?>:</b>
	<?php echo CHtml::encode($data->claimed); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('timestamp')); ?>:</b>
	<?php echo CHtml::encode($data->timestamp); ?>
	<br />


</div>