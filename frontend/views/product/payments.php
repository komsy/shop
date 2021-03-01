<?php

use yii\helpers\Html;
use common\models\User;
use yii\helpers\ArrayHelper;
use yii\bootstrap4\ActiveForm;
use frontend\models\Orders;
use frontend\models\Delivery;
use frontend\models\Countries;
use frontend\models\Paymentmethods;

/* @var $this yii\web\View */
/* @var $model frontend\models\Payments */
/* @var $form ActiveForm */

$orderId = Orders::find()->where(['userId'=>Yii::$app->user->id])->joinWith('user')->all();
$order = Orders::find()->where(['userId'=>Yii::$app->user->id])->one();
$payment = ArrayHelper::map(Paymentmethods::find()->all(), 'paymentMethodId', 'paymentMethodDesc');
$delivery = ArrayHelper::map(Delivery::find()->all(), 'deliveryId', 'deliveryDesc');
$code = ArrayHelper::map(Countries::find()->all(), 'couPhoneCode', 'countryName');
?>

<div class="container">
<div class="payment">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'orderId')->hiddenInput(['value' => $orderId[0]->orderId, 'readonly'=>true])->label(false) ?>
        <?= $form->field($model, 'amount')->hiddenInput(['value' => $order->total, 'readonly'=>true])->label(false)  ?>
        <?= $form->field($model, 'userId')->hiddenInput(['value' =>Yii::$app->user->id, 'readonly'=>true])->label(false) ?>
        <?= $form->field($model, 'paymentMethodId')->dropDownList($payment,['prompt'=>'Select Payment Method'])->label(false) ?>
        <?= $form->field($model, 'deliveryId')->dropDownList($delivery,['prompt'=>'Select Delivery Address'])->label(false) ?>
        <?= $form->field($model, 'phoneCode')->dropDownList($code,['prompt'=>'Select your code'])->label(false) ?>
       <?= $form->field($model, 'mpesaNumber') ?>

        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- payment -->
</div>