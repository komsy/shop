<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use frontend\models\Categories;

/* @var $this yii\web\View */
/* @var $model frontend\models\ProductCategory */
/* @var $form ActiveForm */
?>
<div class="productcategory">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'productId')->hiddenInput(['value' => $productId, 'readonly'=>true])->label(false)  ?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- productcategory -->
