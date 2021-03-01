<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\ProductBrand */
/* @var $form ActiveForm */
?>
<div class="productbrand">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'brandName') ?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- productbrand -->
