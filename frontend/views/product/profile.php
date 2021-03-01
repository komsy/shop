<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\User;
use frontend\models\Currency;
use frontend\models\Countries;
use frontend\models\Delivery;

/* @var $this yii\web\View */
/* @var $model frontend\models\Profile */
/* @var $form ActiveForm */
$currency = ArrayHelper::map(Currency::find()->all(), 'currencyId', 'currencyName');
$code = ArrayHelper::map(Countries::find()->all(), 'couPhoneCode', 'countryName');
$dell = ArrayHelper::map(Delivery::find()->all(), 'deliveryId', 'deliveryDesc');
?>
<div class="container">
<div class="profile">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'userId')->hiddenInput(['value' =>Yii::$app->user->id, 'readonly'=>true])->label(false) ?>
        <?= $form->field($model, 'fullName') ?>
        <?= $form->field($model, 'idNumber') ?>
        <?= $form->field($model, 'phoneNumber') ?>
        <?= $form->field($model, 'delivery')->textInput()->dropDownList($dell,['prompt'=>'Select your Delivery address'])->label(false) ?>
        <?= $form->field($model, 'createdBy')->hiddenInput(['value' =>Yii::$app->user->id, 'readonly'=>true])->label(false) ?>
        <?= $form->field($model, 'currencyId')->textInput()->dropDownList($currency,['prompt'=>'Select your currency'])->label(false) ?>
        <?= $form->field($model, 'phoneCode')->textInput()->dropDownList($code,['prompt'=>'Select your Phonecode'])->label(false) ?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- profile -->
</div>
<a href="<?= Url::to(['product/profile'])?>"><button type="button" val="<?=$list?>" class="btn btn-lg btn-success pull-right deposit">Checkout</button></a>