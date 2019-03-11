<?php

namespace app\models\pricelist;

use Yii;

/**
 * This is the model class for table "sorts".
 *
 * @property int $id
 * @property string $name sort's name
 * @property int $types_id
 * @property string $create_date
 * @property string $comment_ru
 * @property string $comment_en
 * @property string $comment_es
 * @property string $name_en
 * @property string $name_es
 * @property string $name_ru
 * @property int $color_id
 * @property int $is_extand_commission
 * @property string $flag
 * @property string $nl_product_id
 *
 * @property PriceList[] $priceLists
 */
class Sorts extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sorts';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['types_id'], 'required'],
            [['types_id', 'color_id', 'is_extand_commission'], 'integer'],
            [['create_date'], 'safe'],
            [['comment_en', 'comment_es'], 'string'],
            [['name'], 'string', 'max' => 15],
            [['comment_ru'], 'string', 'max' => 255],
            [['name_en', 'name_es', 'name_ru', 'nl_product_id'], 'string', 'max' => 50],
            [['flag'], 'string', 'max' => 4],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'types_id' => 'Types ID',
            'create_date' => 'Create Date',
            'comment_ru' => 'Comment Ru',
            'comment_en' => 'Comment En',
            'comment_es' => 'Comment Es',
            'name_en' => 'Name En',
            'name_es' => 'Name Es',
            'name_ru' => 'Name Ru',
            'color_id' => 'Color ID',
            'is_extand_commission' => 'Is Extand Commission',
            'flag' => 'Flag',
            'nl_product_id' => 'Nl Product ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPriceLists()
    {
        return $this->hasMany(PriceList::className(), ['sorts_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return Sortsquery the active query used by this AR class.
     */
    public static function find()
    {
        return new Sortsquery(get_called_class());
    }
}
