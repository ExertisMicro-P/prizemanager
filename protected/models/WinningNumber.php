<?php

/**
 * This is the model class for table "winning_number_t".
 *
 * The followings are the available columns in table 'winning_number_t':
 * @property integer $id
 * @property string $invoice_no
 * @property integer $prize_id
 * @property integer $claimed
 * @property string $timestamp
 */
class WinningNumber extends MPActiveRecord
{
    const CLAIMED = 1;
    const STATUS_WIN = 'WIN';
    const STATUS_LOSE = 'LOSE';
    const STATUS_CLAIMED = 'CLAIMED';
    const STATUS_INVALID = 'INVALID';
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'winning_number_t';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('prize_id, claimed', 'numerical', 'integerOnly'=>true),
			array('invoice_no', 'length', 'max'=>8),
			array('timestamp', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, invoice_no, prize_id, claimed, timestamp', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
                    'prize'=>array(self::HAS_ONE, 'Prize',array('id'=>'prize_id')),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'invoice_no' => 'Invoice No',
			'prize_id' => 'Prize',
			'claimed' => 'Claimed',
			'timestamp' => 'Timestamp',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('invoice_no',$this->invoice_no,true);
		$criteria->compare('prize_id',$this->prize_id);
		$criteria->compare('claimed',$this->claimed);
		$criteria->compare('timestamp',$this->timestamp,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
                        'sort'=>array('defaultOrder'=>'t.id DESC',
						   'attributes'=>array('*'),
					),
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return WinningNumber the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        /**
	 *
	 * Manage Timestamp and user.
         * Set other default values
	 */
	public function beforeSave() {
	    //if ($this->isNewRecord) {
	        $this->timestamp = new CDbExpression('NOW()');
	    //}
            //$this->username = Yii::app()->user->name;
	    // Yii::log(__METHOD__.': User ID='.Yii::app()->user->id, 'info', 'created file');

	    return parent::beforeSave();
	}
        
        public function isValidInvoiceNumber($invoice){
            $invoice_regex = '/^[0-9]{8}$/';
            if(preg_match($invoice_regex,$invoice)){
                return true;
            }
            else{
                return false;
            }
        }
        
        public function isThisaGoldenTicketWinner($invoice){
            $status = 'CHECK BACK LATER';
             
             $userentry = new UserEntry;
             $userentry->invoice_no = $invoice;
             if (!$userentry->saveWithAuditTrail('invoice '. $invoice . ' entered'))
                    Yii::log(__METHOD__.': Error saving invoice='.print_r($userentry,true),'info','system.controllers.UserEntry');
             
            //check this is a valid number
           if(true){//$this->isValidInvoiceNumber($invoice)){
              $winningnumber = self::model()->findByAttributes(array('invoice_no'=>$invoice));
              if($winningnumber){ //we have a winner
                    //update $winning entry
                 if($winningnumber->claimed == 0){ //not yet claimed
                    $winningnumber->claimed = self::CLAIMED;
                    if (!$winningnumber->saveWithAuditTrail('invoice '. $invoice . ' claimed'))
    			Yii::log(__METHOD__.': Error saving winningnumber='.print_r($winningnumber,true),'info','system.controllers.WinningNumber');
                    $status =  self::STATUS_WIN;
                    Yii::log(__METHOD__.': winningnumber='.$invoice,'info','system.controllers.WinningNumber');
                    $mailer = new Mailer();
                    $content = $this->getmailcontent($winningnumber->prize_id,$invoice);
                    $result = $mailer->mailNotification($content);         
                  }
                  else{
                        ( $status = self::STATUS_CLAIMED);
                  }  //claim              
                } //candidate
                else{
                    $status = self::STATUS_LOSE;
                }
                
                //We need to update the user entry table with number
                //if(UserEntry::model()->findByAttributes(array('invoice_no'=>$invoice)) == null){
                //    $userentry = new UserEntry;
                //    $userentry->invoice_no = $invoice;
                //    if (!$userentry->saveWithAuditTrail('invoice '. $invoice . ' entered'))
    		//	Yii::log(__METHOD__.': Error saving invoice='.print_r($userentry,true),'info','system.controllers.UserEntry');
                
              //  }
                return $status;  
           }//valid candidate
           else{
                $status = self::STATUS_INVALID;
                return $status;
            }
        }
        
        /*
         * Creates an email content specifying - the prize, and winning invoice number
         * Returns the type string content 
         */
        public function getmailcontent($id, $invoice){
            $prize = Prize::model()->findByAttributes(array('id'=>$id));
            $content = 'Prize ' . $prize->desc . ' has been claimed by customer invoice ' . $invoice;
            return $content;
        }
}