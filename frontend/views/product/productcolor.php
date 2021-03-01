<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\ProductColor */
/* @var $form ActiveForm */
?>
<div class="productcolor">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'colorDesc') ?>
        <?= $form->field($model, 'colorCode') ?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- productcolor -->
