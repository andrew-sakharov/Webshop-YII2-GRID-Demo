<?php

namespace app\models\pricelist;

use Yii;

/**
 * This is the model class for table "price_list".
 *
 * @property int $id
 * @property int $users_id
 * @property int $plantations_id
 * @property int $types_id
 * @property int $sorts_id
 * @property string $create_date
 * @property string $update_date Status Change Time
 * @property string $is_deleted
 * @property int $group_id
 * @property string $nl_id
 * @property string $nl_product_id
 * @property int $minimum_length
 * @property int $quantity
 * @property string $flag
 * @property int $price_chargeamount
 * @property string $quality_group
 * @property int $packing_innerpackagequantity
 * @property string $quantity_unitcode
 * @property string $grower
 * @property string $maturity_stage
 *
 * @property Sorts $sorts
 * @property Types $types
 */
class Pricelist extends \yii\db\ActiveRecord
{   
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'price_list';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['plantations_id', 'types_id', 'sorts_id'], 'required'],
            [['plantations_id', 'types_id', 'sorts_id', 'group_id', 'minimum_length', 'quantity'], 'integer'],
            [['quality_group', 'maturity_stage'], 'string', 'max' => 5],
//            ['create_date', 'date', 'timestampAttribute' => 'create_date', 'format' => 'php:d-m-Y'],
            ['myCreateDate', 'date', 'format' => 'php:Y-m-d H:i:s'],
//            ['myCreateDate', 'date'],
//            ['create_date', 'date', 'format' => 'php:d-m-Y'],            
            [[ 'update_date', 'create_date'], 'safe'],
            [['sorts_id'], 'exist', 'skipOnError' => true, 'targetClass' => Sorts::className(), 'targetAttribute' => ['sorts_id' => 'id']],
            [['types_id'], 'exist', 'skipOnError' => true, 'targetClass' => Types::className(), 'targetAttribute' => ['types_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'users_id' => 'Users ID',
            'plantations_id' => 'Plantations ID',
            'types_id' => 'Types ID',
            'sorts_id' => 'Sorts ID',
            'create_date' => 'Create Date',
            'update_date' => 'Update Date',
            'is_deleted' => 'Is Deleted',
            'group_id' => 'Group ID',
            'nl_id' => 'Nl ID',
            'nl_product_id' => 'Nl Product ID',
            'minimum_length' => 'Minimum Length',
            'quantity' => 'Quantity',
            'flag' => 'Flag',
            'price_chargeamount' => 'Price Chargeamount',
            'quality_group' => 'Quality Group',
            'packing_innerpackagequantity' => 'Packing Innerpackagequantity',
            'quantity_unitcode' => 'Quantity Unitcode',
            'grower' => 'Grower',
            'maturity_stage' => 'Maturity Stage',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery 
     */
    public function getSorts()
    {
        return $this->hasOne(Sorts::className(), ['id' => 'sorts_id']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlantations()
    {
        return $this->hasOne(Plantations::className(), ['id' => 'plantations_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTypes()
    {
        return $this->hasOne(Types::className(), ['id' => 'types_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGlnsupply()
    {
        return $this->hasOne(Glnsupply::className(), ['product_id' => 'nl_product_id']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGlaprice()
    {
        return $this->hasMany(Glaprice::className(), ['product_id' => 'nl_id']);
    }
    
    /**
     * {@inheritdoc}
     * @return Pricelistquery the active query used by this AR class.
     */
    public static function find()
    {
        return new Pricelistquery(get_called_class());
    }
    
    public function getMyCreateDate() {
            //        return $this->create_date? date('Y-m-d', $this->create_date) : '';
        return $this->create_date;
    }
    
    public function setMyCreateDate($date) {

          $this->create_date = $date . ' 00:00:00';
//        $this->create_date = $date;

    }
}
