<?php

use yii\helpers\Html;
use common\models\User;
use yii\bootstrap4\Modal;
use yii\bootstrap4\ActiveForm;
use yii\helpers\ArrayHelper;
use frontend\models\Productcolor;
use frontend\models\Productimages;
use frontend\models\Productbrand;
use frontend\models\Productuom;
use frontend\models\Categories;

/* @var $this yii\web\View */
/* @var $model frontend\models\Product */
/* @var $form yii\widgets\ActiveForm */

$userId = user::find()->where(['id'=>Yii::$app->user->id])->one();

$uoms = ArrayHelper::map(Productuom::find()->all(), 'uomId', 'uomDesc');
$colors = ArrayHelper::map(Productcolor::find()->all(), 'colorId', 'colorDesc');
$images = ArrayHelper::map(Productimages::find()->all(), 'imageId', 'imagePath');
$brands = ArrayHelper::map(Productbrand::find()->all(), 'brandId', 'brandName');
$category = ArrayHelper::map(Categories::find()->all(), 'categoryId', 'categoryDesc');
$Newimages = new frontend\models\Productimages;
?>
<div class="container">
    <div class="stepwizard">
        <div class="stepwizard-row setup-panel">
            <div class="stepwizard-step col-xs-4"> 
                <a href="#step-1" type="button" class="btn btn-success btn-circle">1</a>
                <p><small>Add Product</small></p>
            </div>
            <div class="stepwizard-step col-xs-4"> 
                <a href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disabled">2</a>
                <p><small>Add product Images</small></p>
            </div>
            <div class="stepwizard-step col-xs-4"> 
                <a href="#step-3" type="button" class="btn btn-default btn-circle" disabled="disabled">3</a>
                <p><small>Preview</small></p>
            </div>
        </div>
    </div>
    
   <?php $form = ActiveForm::begin(['id' => 'product-create'],[
        'options' => ['enctype' => 'multipart/form-data']
    ]); ?>
        <div class="panel panel-primary setup-content" id="step-1">
            <div class="row">
                <div class="col-md-3">
                    <button type="button" class="btn btn-block btn-outline-dark btn-small categories"><i class="fa fa-plus" aria-hidden="true"></i> Add Category</button>
                </div> 
                <div class="col-md-3">
                    <button type="button" class="btn btn-block btn-outline-dark btn-small delivery"><i class="fa fa-plus" aria-hidden="true"></i> Add Delivery</button>
                </div>
                <div class="col-md-3">
                    <button type="button" class="btn btn-block btn-outline-dark btn-small methods"><i class="fa fa-plus" aria-hidden="true"></i> Add Payment Method</button>
                </div>
                </div>
            <div class="panel-heading">
                 <h3 class="panel-title">Add Product</h3>
            </div>
            <div class="panel-body">
                <div class="product-form">
               
                <?php echo $form->errorSummary($model) ?>
                <?= $form->field($model, 'productName')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'productDesc')->textarea(['rows' => 6]) ?>
                 <?= $form->field($model, 'created_by')->textInput()->hiddenInput(['value' => $userId->id, 'readonly'=>true])->label(false) ?>
                 <?= $form->field($model, 'updated_by')->hiddenInput(['value'=>yii::$app->user->id])->label(false) ?> 
            </div> 
                <button class="btn btn-primary nextBtn pull-right" type="button">Next</button>
            </div>
        </div>
        
        <div class="panel panel-primary setup-content" id="step-2">
            <div class="panel-heading">
                 <h3 class="panel-title">Add Product Images</h3>
            </div>
            <div class="panel-body">
                            <?= $form->field($model, 'basePrice')->textInput(['maxlength' => true]) ?>
                <div class="row">
                <div class="col-sm-6">
                    <?= $form->field($model, 'uomId')->dropDownList($uoms,['prompt'=>'Select unit of measurement'])->label(false) ?>
                </div> 
                <div class="col-sm-4">
                    <button type="button" class="btn btn-block btn-outline-dark btn-small productuom"><i class="fa fa-plus" aria-hidden="true"></i> Unit of Measurement</button>
                </div> 
                </div>
                <div class="row">
                <div class="col-sm-6">
                    <?= $form->field($model, 'brandId')->dropDownList($brands,['prompt'=>'Select brand'])->label(false) ?>
                </div> 
                <div class="col-sm-4">
                    <button type="button" class="btn btn-block btn-outline-dark btn-small productbrand"><i class="fa fa-plus" aria-hidden="true"></i> Brand</button>
                </div> 
                </div>
                <div class="row">
                <div class="col-sm-6">
                    <?= $form->field($model, 'colorId')->dropDownList($colors,['prompt'=>'Select color'])->label(false) ?>
                </div> 
                <div class="col-sm-4">
                    <button type="button" class="btn btn-block btn-outline-dark btn-small productcolor"><i class="fa fa-plus" aria-hidden="true"></i>Color</button>
                </div> 
                </div>
                            <button class="btn btn-primary nextBtn pull-right" type="button">Next</button>
            
            </div>
        </div>
        
        <div class="panel panel-primary setup-content" id="step-3">
            <div class="panel-heading">
                 <h3 class="panel-title">Add Product Images</h3>
            </div>
             <div class="panel-body">
                <?= $form->field($image, 'imagePath')->fileInput() ?>
                   <div class="form-group">
                    <?= Html::submitButton(Yii::t('app', 'Finish'), ['class' => 'btn btn-primary nextBtn pull-right"']) ?>
                </div>
            
            </div>
        </div>
    <?php ActiveForm::end(); ?>
</div>
<?php
    Modal::begin([
        'id'=>'productbrand',
        'size'=>'modal-lg'
        ]);
    echo "<div id='productbrandContent'></div>";
    Modal::end();
  ?>
  <?php
    Modal::begin([
        'id'=>'delivery',
        'size'=>'modal-lg'
        ]);
    echo "<div id='deliveryContent'></div>";
    Modal::end();
  ?>

     <?php
    Modal::begin([
        'id'=>'productcolor',
        'size'=>'modal-lg'
        ]);
    echo "<div id='productcolorContent'></div>";
    Modal::end();
  ?>
     <?php
    Modal::begin([
        'id'=>'productuom',
        'size'=>'modal-lg'
        ]);
    echo "<div id='productuomContent'></div>";
    Modal::end();
  ?>
  <?php
    Modal::begin([
        'id'=>'categories',
        'size'=>'modal-lg'
        ]);
    echo "<div id='categoriesContent'></div>";
    Modal::end();
  ?>
    <?php
    Modal::begin([
        'id'=>'methods',
        'size'=>'modal-lg'
        ]);
    echo "<div id='methodsContent'></div>";
    Modal::end();
  ?>