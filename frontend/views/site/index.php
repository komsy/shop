<?php
/* @var $this yii\web\View */
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap4\Modal;
use yii\helpers\StringHelper;
use frontend\models\ProductColor;
use frontend\models\Productimages;
use frontend\models\ProductBrand;
use frontend\models\ProductUom;
use frontend\models\Product;

$this->title = '#3ies';
 
$listings = Productimages::find()->joinWith('product')->limit(4)->all();
$lists = Productimages::find()->orderBy(['productId'=>SORT_DESC])->joinWith('product')->limit(4)->all();

?>
        
        <!--background image -->
        <div class="hero-image bgimg">
          <div class="hero-text">
            <h1 style="font-size:50px">Built for <br> Flight</h1>
            <h6>Introducing Sneakers</h6>
            <h6>The all weather shoe</h6>
            <a href="#" class="btn btn-dark">Shop</a>
          </div>
        </div>

    <div class="wrapper">
        <div class="row">
            <div class="col-md-6 sm-6">
                <h3>Women Shoes</h3>
                <div class="text-center">
                  <div class="card1">
                <img src="<?= Yii::$app->request->baseUrl ?>/images/wm10.jpg?>" class="card-img-top" alt="Women's Shoe">
                <div class="card-body">
                  <a href="<?= Url::to(['women/index'])?>"> <button class="btn btn-primary">Shop Now <i class="fa fa-arrow-right" aria-hidden="true"></button></i></a>
                </div>
              </div>
                </div>
            </div>
            <div class="col-md-6 sm-6">
                <h3>Men Shoes</h3>
                <div class="text-center">
                  <div class="card1" style="margin-right: 20px;">
                <img src="<?= Yii::$app->request->baseUrl ?>/images/sh13.jpg?>" class="card-img-top" alt="Men's shoe">
                <div class="card-body">
                <a href="<?= Url::to(['men/index'])?>"> <button class="btn btn-primary">Shop Now <i class="fa fa-arrow-right" aria-hidden="true"></button></i></a>
                 </div>
              </div>
                </div>
            </div>
        </div>

        <!-- / new releases section-->
        <div class="row">
            <div class="col">
                <h3>New Releases</h3>
            </div>
        </div>

       <div class="all">
    <div class="row">
    <?php foreach ($lists as $listing ) {?>
    
    <div class="col-md-3 sm-3">
      <div class="card">
          <img src="<?= Yii::$app->request->baseUrl.'/'.$listing->imagePath ?>" class="card-img-top" alt="shoes">
          <div class="card-body ">
            <h5 class="card-title"><?=$listing->product->productName ?></h5>
            <p class="card-text">Ksh. <?=$listing->product->basePrice ?>
              <br> <?=$listing->product->productDesc ?></p> 
             <a href="#"><button type="button" val="<?=$listing->productId?>"class="btn btn-success addcart">Add Cart</button></a> 
       </div>
        </div>
    </div>
    <br>
     <?php } ?>
    </div>
<!-- / New releases section-->

        <!--  top picks section-->
        <div class="row">
            <div class="col">
            <h3>Top Kicks </h3>
            </div>
        </div>
    <div class="row">
    <?php foreach ($listings as $listing ) {?>
    
    <div class="col-md-3 sm-3">
      <div class="card">
          <img src="<?= Yii::$app->request->baseUrl.'/'.$listing->imagePath ?>" class="card-img-top" alt="shoes">
          <div class="card-body ">
            <h5 class="card-title"><?=$listing->product->productName ?></h5>
            <p class="card-text">Ksh. <?=$listing->product->basePrice ?>
              <br> <?=$listing->product->productDesc ?></p> 
               <a href="#"><button type="button" val="<?=$listing->productId?>"class="btn btn-success addcart">Add Cart</button></a> 

          </div>
        </div><!-- /card-->
    </div><!-- /col-md-3 -->
    <br>
     <?php } ?>
    </div>
</div>
 <!-- / Top picks section-->

        <!-- mailing section-->
        <div class="row">
            <div class="center">
                  <h1>Never Miss <br> a drop</h1>
                  <h5> Receive Updates about new <br> products and promotions </h5>
                  <button type="button" class="btn btn-outline-primary">Join Mailing List</button>
                </div>
        </div>  <!-- / mailing section-->
    </div>  <!-- / wrapper section-->


<?php

Modal::begin([
    'title'=>'<h4> ADD CART</h4>',
    'id'=>'addcart',
    'size'=>'model-lg',
    ]);
    echo "<div id='addcartContent'></div>";
Modal::end();

?>