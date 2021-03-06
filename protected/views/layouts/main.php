<?php /* @var $this Controller */ ?>
<?php Yii::app()->bootstrap->register(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />
        <meta http-equiv="cache-control" content="max-age=0" />
        <meta http-equiv="cache-control" content="no-cache" />
        <meta http-equiv="expires" content="0" />
        <meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
        <meta http-equiv="pragma" content="no-cache" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container" id="page">

	<!--<div id="header">
		<div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?></div>
	</div>--><!-- header -->


		<?php /*$this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>'Home', 'url'=>array('/site/index')),
				array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about')),
				array('label'=>'Contact', 'url'=>array('/site/contact')),
				array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
				array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
			),
		)); */?>

            <?php
            $this->widget('bootstrap.widgets.TbNavbar', array(
    'brandLabel' => CHtml::encode(Yii::app()->name),
    'display' => null, // default is static to top
    'collapse' => true,
    'items' => array(
        array(
            'class' => 'bootstrap.widgets.TbNav',
            'items' => array(
                //array('label'=>'Home', 'url'=>array('/site/index')),
				//array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about')),
				//array('label'=>'Contact', 'url'=>array('/site/contact')),
                                array('label'=>'Enter Winning Numbers', 'url'=>array('/winningnumber/enternumbers'), 'visible'=>(Yii::app()->user->checkAccess('menu.winningnumber') && Yii::app()->user->checkAccess('winningnumber.enternumbers')) ),
                                array('label'=>'Users Entries', 'url'=>array('/userentry/admin'), 'visible'=>Yii::app()->user->checkAccess('menu.userentry')),
                                array('label'=>'Manage Prizes', 'url'=>array('/prize/admin'), 'visible'=>Yii::app()->user->checkAccess('menu.prize')),
				array('label'=>'Permissions', 'url'=>array('/auth'), 'visible'=>Yii::app()->user->isAdmin),
				array('label'=>'Users', 'url'=>array('/user'), 'visible'=>Yii::app()->user->isAdmin),
				array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
				array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
            ),
        ),
    ),
)); ?>


	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>

	<div class="clear"></div>

	<div id="footer">
			Copyright &copy;
			<?php echo date('Y'); ?>
			by Micro-P.&nbsp;|&nbsp; All Rights Reserved.&nbsp;|&nbsp;
			<?php echo Yii::powered(); ?>
			<?php
		if (isset($this->svnversion))
			echo "&nbsp;|&nbsp;Version: ".$this->svnversion;
		else
			echo "&nbsp;|&nbsp;No Version";

                $enviromentManager = new MPEnvironments();
                $curEnvironment = $enviromentManager->getCurrentEnvironment();

                echo ' | '.$curEnvironment['dbhost'].' | '.$curEnvironment['dbname'];
		?>
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>
