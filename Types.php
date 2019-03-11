<?php

namespace app\models\pricelist;

use Yii;

/**
 * This is the model class for table "types".
 *
 * @property int $id
 * @property string $name
 * @property string $name_en
 * @property string $name_es
 * @property string $name_ru
 * @property string $flag
 * @property string $name_nl
 *
 * @property PriceList[] $priceLists
 * @property SizesHasTypes[] $sizesHasTypes
 */
class Types extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'types';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 4],
            [['name_en', 'name_es', 'name_ru', 'name_nl'], 'string', 'max' => 255],
            [['flag'], 'string', 'max' => 3],
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
            'name_en' => 'Name En',
            'name_es' => 'Name Es',
            'name_ru' => 'Name Ru',
            'flag' => 'Flag',
            'name_nl' => 'Name Nl',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPriceLists()
    {
        return $this->hasMany(PriceList::className(), ['types_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSizesHasTypes()
    {
        return $this->hasMany(SizesHasTypes::className(), ['types_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return TypesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TypesQuery(get_called_class());
    }
}
