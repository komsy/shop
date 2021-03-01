<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Paymentmethods */
/* @var $form ActiveForm */
?>
<div class="payment">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'paymentMethodDesc') ?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- payment -->
