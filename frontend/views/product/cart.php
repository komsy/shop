<?php 
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap4\Modal;
use yii\helpers\StringHelper;
use frontend\models\Productimages;
use frontend\models\Product;
use frontend\models\Cartitems;
use yii\bootstrap4\ActiveForm;



$cart= Cartitems::find()->joinWith('cart')->where(['userId'=>Yii::$app->user->id])->joinWith('product')->joinWith('productimages')->all();

$cartPrice = CartItems::find()->joinWith('product')->sum('basePrice');

?>

<script src="https://use.fontawesome.com/c560c025cf.js"></script>
<div class="container">
   <div class="card shopping-cart">
            <div class="card-header bg-dark text-light">
                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                Shipping cart
                <a href="<?= Url::to(['product/listing'])?>" class="btn btn-outline-info btn-sm pull-right">Continue shopping</a>
                <div class="clearfix"></div>
            </div>
            <div class="card-body">
                    <!-- PRODUCT -->
                    <div class="row">

        <?php foreach ($cart as $listing ) {?>            
           <?php
           $list = $listing->quantity * $listing->product->basePrice ?>
                        <div class="col-md-2">
                            <img class="img-responsive" src="<?= Yii::$app->request->baseUrl.'/'.$listing->productimages[0]->imagePath ?>" alt="prewiew" width="120" height="50">
                        </div>
                        <div class="col-md-4 text-center">
                            <h4 class="product-name"><strong><?=$listing->product->productName ?></strong></h4>
                            <h4>
                                <small><?=$listing->product->productDesc ?></small>
                            </h4>
                        </div>
                        <div class="col-md-4">
                             <div class="row">
                            <div class="col-md-6 text-md-right" style="padding-top: 5px">
                                <h6><strong>Ksh. <?=$listing->product->basePrice ?></strong></h6>
                            </div>
                            <div class="col-md-6">
                                  Quant:  <?=$listing->quantity ?>
                            </div>
                            
                        </div>
                        </div>
                        <div class="col-md-2">
                            <h4 class="product-name"><strong><?=$list?></strong></h4>
                        </div>
                    <!-- END PRODUCT -->

                     <br>
         <?php } ?>
                    </div> 
                        <div class="row shadow card-footer">
                            <div class="col-md-4">
                            </div>
                            <div class="col-md-4">
                              <h1>Ksh <?=$cartPrice ?>  </h1>         
                            </div>
                            <div class="col-md-4">
                                 <a href="#" baseUrl="<?= Yii::$app->request->baseUrl?>" productid="<?= $listing->product->productId?>" total="<?=$cartPrice ?>" userid="<?= Yii::$app->user->id?>" class="btn btn-lg btn-success pull-right text-uppercase addorder"> Checkout </a>
                                
                            </div>
                        </div>
                    <hr>
          </div>
        </div>
</div>
