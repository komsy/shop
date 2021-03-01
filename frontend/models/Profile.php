<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "profile".
 *
 * @property int $profileId
 * @property int $userId
 * @property string $fullName
 * @property int $idNumber
 * @property int $currencyId
 * @property int $phoneCode
 * @property int $phoneNumber
 * @property int $delivery
 * @property string $createdAt
 * @property int $createdBy
 *
 * @property Currency $currency
 * @property User $user
 * @property User $createdBy0
 * @property Delivery $delivery0
 */
class Profile extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'profile';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['userId', 'fullName', 'idNumber', 'currencyId', 'phoneCode', 'phoneNumber', 'delivery', 'createdBy'], 'required'],
            [['userId', 'idNumber', 'currencyId', 'phoneCode', 'phoneNumber', 'delivery', 'createdBy'], 'integer'],
            [['createdAt'], 'safe'],
            [['fullName'], 'string', 'max' => 255],
            [['currencyId'], 'exist', 'skipOnError' => true, 'targetClass' => Currency::className(), 'targetAttribute' => ['currencyId' => 'currencyId']],
            [['userId'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['userId' => 'id']],
            [['createdBy'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['createdBy' => 'id']],
            [['delivery'], 'exist', 'skipOnError' => true, 'targetClass' => Delivery::className(), 'targetAttribute' => ['delivery' => 'deliveryId']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'profileId' => 'Profile ID',
            'userId' => 'User ID',
            'fullName' => 'Full Name',
            'idNumber' => 'Id Number',
            'currencyId' => 'Currency ID',
            'phoneCode' => 'Phone Code',
            'phoneNumber' => 'Phone Number',
            'delivery' => 'Delivery',
            'createdAt' => 'Created At',
            'createdBy' => 'Created By',
        ];
    }

    /**
     * Gets query for [[Currency]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCurrency()
    {
        return $this->hasOne(Currency::className(), ['currencyId' => 'currencyId']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'userId']);
    }

    /**
     * Gets query for [[CreatedBy0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy0()
    {
        return $this->hasOne(User::className(), ['id' => 'createdBy']);
    }

    /**
     * Gets query for [[Delivery0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDelivery0()
    {
        return $this->hasOne(Delivery::className(), ['deliveryId' => 'delivery']);
    }
}
