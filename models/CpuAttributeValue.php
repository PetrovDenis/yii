<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cpu_attribute_value".
 *
 * @property integer $cpu_attribute_value_id
 * @property string $value
 * @property integer $cpu_id
 * @property integer $cpu_attribute_id
 *
 * @property Cpu $cpu
 * @property CpuAttribute $cpuAttribute
 */
class CpuAttributeValue extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cpu_attribute_value';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cpu_id', 'cpu_attribute_id'], 'required'],
            [['cpu_id', 'cpu_attribute_id'], 'integer'],
            [['value'], 'string', 'max' => 2048],
            [['cpu_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cpu::className(), 'targetAttribute' => ['cpu_id' => 'cpu_id']],
            [['cpu_attribute_id'], 'exist', 'skipOnError' => true, 'targetClass' => CpuAttribute::className(), 'targetAttribute' => ['cpu_attribute_id' => 'cpu_attribute_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'cpu_attribute_value_id' => Yii::t('app', 'Cpu Attribute Value ID'),
            'value' => Yii::t('app', 'Value'),
            'cpu_id' => Yii::t('app', 'Cpu ID'),
            'cpu_attribute_id' => Yii::t('app', 'Cpu Attribute ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCpu()
    {
        return $this->hasOne(Cpu::className(), ['cpu_id' => 'cpu_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCpuAttribute()
    {
        return $this->hasOne(CpuAttribute::className(), ['cpu_attribute_id' => 'cpu_attribute_id']);
    }
}
