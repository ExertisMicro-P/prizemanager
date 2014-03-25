<?php

class WinningNumberController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return CMap::mergeArray(parent::filters(),array(
		'accessControl', // perform access control for CRUD operations
                    //array('auth.filters.AuthFilter'),
                     array(
                        'RestfullYii.filters.ERestFilter +
                        REST.GET, REST.PUT, REST.POST, REST.DELETE'
                    ),
		));
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			
             array('allow', 'actions'=>array('REST.GET', 'REST.PUT', 'REST.POST', 'REST.DELETE'),
            'users'=>array('*'),
            ),
                    );
	}
        
        public function actions()
        {
            return array(
                'REST.'=>'ext.RestfullYii.starship.RestfullYii.actions.ERestActionProvider',
            );
        }
        
         public function restEvents()
        {
             $this->onRest('req.cors.access.control.allow.origin', function() {
                 return['*'];
             });
             
             $this->onRest('req.cors.access.control.allow.methods', function() {
                 return['GET','POST'];
             });
             
             
            $this->onRest('req.auth.ajax.user', function() {
                return true;
            });
           
            $this->onRest('req.post.ticket.render', function($data, $param1) {
                //$data is the data sent in the POST
                
                $status = WinningNumber::model()->isThisaGoldenTicketWinner($param1);
                
                echo CJSON::encode(['status'=>$status]);
            });
            
        
        }

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
            
	}

        
        public function actionAjaxchecknumberisvalid(){
             $status = 'available';
             if(isset($_POST['number'])){
                $number = $_POST['number'];
                if(!WinningNumber::model()->findByAttributes(array('invoice_no'=>$number))==null){
                //we have entered this number as a winner already. So can't be used
                   echo CJSON::encode(['status'=>'used']);
                   return;
                }
                 if(!UserEntry::model()->findByAttributes(array('invoice_no'=>$number)) == null){
                  echo  CJSON::encode(['status'=>'used']);
                  return;
                } 
                echo  CJSON::encode(['status'=>'valid']);
             }
        }
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new WinningNumber;
                $today = date('Y-m-d');
                $prize = Prize::model()->findByAttributes(array('offer_date'=>$today));
                $data = '';
                $entries = 0;
                
                
                $todays_winners=new CActiveDataProvider('WinningNumber', array(
                    'criteria'=>array(
                    'condition'=>"prize_id=".$prize->id,
                    ),
                    'pagination'=>array(
                    'pageSize'=>10,
                    ),
                ));
                
               
                //a quick validation to ensure entries not required.
                //$todays_winners = WinningNumber::model()->findByAttributes(array('prize_id'=>$prize->id));
                if($todays_winners){ //previous entries find out how many
                    $entries = WinningNumber::model()->countByAttributes(array('prize_id'=>$prize->id));
                }
		
		if (isset($_POST['WinningNumber'])) {
                        $invoices = $_POST['WinningNumber'];
                        $error=array();
                        foreach($invoices as $invoice){
                            $model=new WinningNumber;
                            $model->invoice_no = $invoice['invoice_no'];
                            $model->prize_id = $_POST['prize_id'];
                            if($model->invoice_no){
                                if (!$model->saveWithAuditTrail('invoice '. $invoice['invoice_no'] . 'created')){
                                    Yii::log(__METHOD__.': Error saving winningnumber='.print_r($winningnumber,true),'info','system.controllers.WinningNumber');
                                    $error[] = $invoice['invoice_no'];
                                }  
                            }
                        }
			if(empty($error)){
                            $this->redirect(array('admin'));
                        }
                        
			//if ($model->save()) {
			//	$this->redirect(array('view','id'=>$model->id));
			//}
		}

		$this->render('create',array(
			'model'=>$model, 'prize'=>$prize, 'todays_winners'=>$todays_winners, 'entries'=>$entries
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if (isset($_POST['WinningNumber'])) {
			$model->attributes=$_POST['WinningNumber'];
			if ($model->save()) {
				$this->redirect(array('view','id'=>$model->id));
			}
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if (Yii::app()->request->isPostRequest) {
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if (!isset($_GET['ajax'])) {
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
			}
		} else {
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
		}
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('WinningNumber');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new WinningNumber('search');
		$model->unsetAttributes();  // clear any default values
		if (isset($_GET['WinningNumber'])) {
			$model->attributes=$_GET['WinningNumber'];
		}

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return WinningNumber the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=WinningNumber::model()->findByPk($id);
		if ($model===null) {
			throw new CHttpException(404,'The requested page does not exist.');
		}
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param WinningNumber $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if (isset($_POST['ajax']) && $_POST['ajax']==='winning-number-form') {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}