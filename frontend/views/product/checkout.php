<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap4\Modal;
use yii\helpers\StringHelper;
use frontend\models\Profile;
use frontend\models\Delivery;
use frontend\models\Orders;
use common\models\User;

/*$totalprice=Cart::find()->joinWith('listing')->sum('price');
$totalitems=Cart::find()->joinWith('listing')->sum('userId');
*/
$userId = user::find()->where(['id'=>Yii::$app->user->id])->one();
$listing = Orders::find()->where(['userId'=>Yii::$app->user->id])->one();
?>
<script>
function analyzeColor2(myColor) {
  if (myColor == "card") {
    alert("Payment successfully made!");
    }
    else if(myColor == "mpesa") {
      alert("Check your phone request has successfully been sent!")
    }
  function displayModal(){
      $('myModal').modal('show')    
    }
}
</script>

  <div class="col d-flex justify-content-center">
    <div class="card shadow" style="width:30%;">
    <div class="card-body">
      <h1 class="card-title text-center" style="font-weight: bold;">3Wies Online Shopping </h1>
      <h4>Choose your preffered payment method</h4> 
      <h6 class="text-muted">Trusted payment, 100% Money Back Guarantee</h6>
      <form action="#">
          <!-- Input trigger order now modal -->
       <label for="mpesa">Mpesa</label> <img src="<?= Yii::$app->request->baseUrl ?>/css/images/mpesa.png?>" class="deposit" >
        <br>
      </form>
      <hr class="line">
        
       <div class="row invoice">
        <div class="col text-center">
          <h5>Amount: Ksh <?=$listing->total?> </h5>
        </div>
      </div>
    </div>
  </div>
  </div>
  <?php
    Modal::begin([
        'id'=>'deposit',
        'size'=>'modal-lg'
        ]);
    echo "<div id='depositContent'></div>";
    Modal::end();
  ?>