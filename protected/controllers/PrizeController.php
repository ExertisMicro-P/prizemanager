<?php

class PrizeController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return CMap::mergeArray(parent::filters(),array(
		//'accessControl', // perform access control for CRUD operations
                    //array('auth.filters.AuthFilter'),
                     array(
                        'RestfullYii.filters.ERestFilter +
                        REST.GET, REST.PUT, REST.POST, REST.DELETE'
                    ),
                    array('auth.filters.AuthFilter  -
                        REST.GET, REST.PUT, REST.POST, REST.DELETE'),
		));
	}
        
        
        public function restEvents()
        {
            $this->onRest('req.cors.access.control.allow.origin', function() {
                 return['*'];
             });
             $this->onRest('req.cors.access.control.allow.headers', function() {
                return ['Origin, X-Requested-With, Content-Type, Accept, Access-Control-Allow-Origin'];
            });
            
             $this->onRest('req.cors.access.control.allow.methods', function() {
                 return['GET','POST'];
             });
             
             $this->onRest('pre.filter.req.auth.cors', function($allowed_origins) {
                    return $allowed_origins; //Array
                });
         
            $this->onRest('req.auth.ajax.user', function() {
                return true;
            });
              $this->onRest('req.auth.cors', function() {
                return true;
            });
            $this->onRest('req.get.resources.render', function($param1)
            {
               if (isset($_SERVER['HTTP_REFERER'])) {
                $http_referer = parse_url($_SERVER['HTTP_REFERER']);
                $domain = $http_referer['host'];

                    $http_origin = $domain;
                    if ($http_origin == "icom.sandbox.websys.co.uk" || $http_origin == "www.exertismicro-p.co.uk")
                {
                       header('Access-Control-Allow-Origin: '.$http_referrer['scheme'].$http_referrer['host']);
                    }
                } else {
                    header('Access-Control-Allow-Origin: *');
                }
                //header('Content-Type: application/json');
                echo CJSON::encode(['prizes'=>Prize::model()->getPrizes()]);
            });
        }


        public function actions()
        {
            return array(
                'REST.'=>'RestfullYii.actions.ERestActionProvider',
            );
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
//            array('deny',  // deny all users
//                'users'=>array('*'),
//           ),
		);
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

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Prize;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if (isset($_POST['Prize'])) {
			$model->attributes=$_POST['Prize'];
			if ($model->save()) {
				$this->redirect(array('view','id'=>$model->id));
			}
		}
                //get all dates so far used
                $dates =Prize::model()->getUnavailableDates();
                
		$this->render('create',array(
			'model'=>$model,
                        'dates'=>$dates
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

		if (isset($_POST['Prize'])) {
			$model->attributes=$_POST['Prize'];
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
		$dataProvider=new CActiveDataProvider('Prize');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Prize('search');
		$model->unsetAttributes();  // clear any default values
		if (isset($_GET['Prize'])) {
			$model->attributes=$_GET['Prize'];
		}

		$this->render('admin',array(
			'model'=>$model,'mystuf'=>'yes'
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Prize the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Prize::model()->findByPk($id);
		if ($model===null) {
			throw new CHttpException(404,'The requested page does not exist.');
		}
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Prize $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if (isset($_POST['ajax']) && $_POST['ajax']==='prize-form') {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
        
      
        public function actionAjaxgetprizesavailable(){
            //Prize::model()->getPrizes()
        }
        
}