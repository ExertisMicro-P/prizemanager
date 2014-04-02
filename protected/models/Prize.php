<?php

/**
 * This is the model class for table "prize_t".
 *
 * The followings are the available columns in table 'prize_t':
 * @property integer $id
 * @property string $desc
 * @property string $offer_date
 * @property integer $qty
 * @property string $timestamp
 * @property string $reference
 * @property string $extraproperty
 */
class Prize extends MPActiveRecord
{
    public $extraproperty;
    
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'prize_t';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('qty', 'numerical', 'integerOnly'=>true),
			array('desc', 'length', 'max'=>200),
			array('reference', 'length', 'max'=>50),
			array('offer_date, timestamp', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, desc, offer_date, qty, timestamp, reference', 'safe', 'on'=>'search'),
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
                    'winningnumbers'=>array(self::HAS_MANY, 'WinningNumber','prize_id'),
		);
	}
        
        
        public function attributes() {
            return array_merge(parent::attributes(), array('new'=>'XXXXXXX'));
        }

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'desc' => 'Description',
			'offer_date' => 'Offer Date',
			'qty' => 'Qty',
			'timestamp' => 'Timestamp',
			'reference' => 'Reference',
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
		$criteria->compare('desc',$this->desc,true);
		$criteria->compare('offer_date',$this->offer_date,true);
		$criteria->compare('qty',$this->qty);
		$criteria->compare('timestamp',$this->timestamp,true);
		$criteria->compare('reference',$this->reference,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Prize the static model class
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
           $this->offer_date = date('Y-m-d', strtotime( $this->offer_date));
            return parent::beforeSave();
}

	
        
        
        public function getPrizes(){
            
            $dataProvider = Yii::app()->db->createCommand()
  			->select("p.*, COUNT(w.claimed) AS claimed")
  			->from($this->tableName() . ' p')
                        ->leftjoin('winning_number_t w', 'p.id=w.prize_id AND w.claimed=1')
                        ->group('p.id')
                        ->order('offer_date ASC')
                        ->queryAll();
             return $dataProvider;
        }
        
        
        /*
         * Get all offer_dates recorded in prize_t and returns them as an array
         */
        public function getUnavailableDates(){
            
            $rawData = Yii::app()->db->createCommand()
  			->select("offer_date")
  			->from($this->tableName())
                        ->queryAll();
            
            $dataprovider = new CArrayDataProvider($rawData,array('pagination'=>false));
            return $dataprovider->getData();
        
        }
}
