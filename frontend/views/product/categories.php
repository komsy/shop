<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Categories */
/* @var $form ActiveForm */
?>
<div class="categories">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'categoryDesc') ?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- categories -->
