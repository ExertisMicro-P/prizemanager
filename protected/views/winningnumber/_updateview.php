<?php
/* @var $this WinningNumberController */
/* @var $data WinningNumber */
?>

<div class="view">

    	<?php $this->widget('zii.widgets.CDetailView',array(
    'htmlOptions' => array(
        'class' => 'table table-striped table-condensed table-hover',
    ),
    'data'=>$model,
    'attributes'=>array(
		'id',
		'invoice_no',
		'prize_id',
		'claimed',
	),
)); ?>
</div>