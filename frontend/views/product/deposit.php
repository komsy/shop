<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\User;
use frontend\models\Productcart;
use frontend\models\Delivery;
use frontend\models\Countries;
use frontend\models\Orders;

/* @var $this yii\web\View */
/* @var $model frontend\models\Deposit */
/* @var $form ActiveForm */

$orderId = Orders::find()->where(['userId'=>Yii::$app->user->id])->joinWith('user')->all();
$code = ArrayHelper::map(Countries::find()->all(), 'couPhoneCode', 'countryName');
$order = Orders::find()->where(['userId'=>Yii::$app->user->id])->one();
$delivery = ArrayHelper::map(Delivery::find()->all(), 'deliveryId', 'deliveryDesc');
?>

    <div class="deposit">
    <div class="col d-flex justify-content-center">
    <div class="card shadow" style="width:30%;">
    <div class="card-body">
      <h1 class="card-title text-center" style="font-weight: bold;">3Wies Online Shopping </h1>
      <h4>Choose your preffered payment method</h4> 
      <h6 class="text-muted">Trusted payment, 100% Money Back Guarantee</h6>
      <form action="#">
          <!-- Input trigger order now modal -->
       <label for="mpesa">Mpesa</label> <img src="<?= Yii::$app->request->baseUrl ?>/css/images/mpesa.png?>" class="deposit" >
        <br>
      </form>
      <hr class="line">
         <p class="text-center" style="font-weight: bold;">Enter Your MPESA PIN on prompt pop-up on your phone to complete the payment</p>
         
         <?php $form = ActiveForm::begin(); ?>
            <?= $form->field($model, 'orderId')->hiddenInput(['value' => $orderId[0]->orderId, 'readonly'=>true])->label(false) ?>
           <?= $form->field($model, 'deliveryId')->dropDownList($delivery,['prompt'=>'Select Delivery Address'])->label(false) ?>
            <?= $form->field($model, 'transAmount')->hiddenInput(['value' => $order->total, 'readonly'=>true])->label(false)  ?>
            <?= $form->field($model, 'phoneCode')->textInput()->dropDownList($code,['prompt'=>'Select your Phonecode'])->label(false) ?>
            <?= $form->field($model, 'mpesaNumber') ?>
            <?= $form->field($model, 'createdBy')->hiddenInput(['value' =>Yii::$app->user->id, 'readonly'=>true])->label(false) ?>
            <?= $form->field($model, 'MerchantRequestId')->hiddenInput(['value' =>Yii::$app->user->id, 'readonly'=>true])->label(false) ?>
        
            <div class="form-group">
                <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
            </div>
        <?php ActiveForm::end(); ?>
        <div class="row invoice">
      </div>
    </div>
  </div>
  </div>
</div><!-- deposit -->
