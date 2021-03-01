<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Productuom */
/* @var $form ActiveForm */
?>
<div class="productuom">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'uomDesc') ?>
        <?= $form->field($model, 'uomPrice') ?>
        <?= $form->field($model, 'quantity') ?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- productuom -->
