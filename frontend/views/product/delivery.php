<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Delivery */
/* @var $form ActiveForm */
?>
<div class="delivery">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'deliveryDesc') ?>
        <?= $form->field($model, 'cost') ?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- delivery -->
