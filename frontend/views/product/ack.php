<?php
use yii\helpers\Url;
use yii\helpers\Html;

?>


  <div class="col1 d-flex justify-content-center">
    <div class="card shadow">
    <div class="card-body">
    <h2 class="text-muted">Congratulations your order was successfully made!</h2> 
    <h6>An Email has been sent to you </h6>
    Click here to download the receipt
    <?php echo Html::a('<i class="fa far fa-hand-point-up"></i> Privacy Statement', ['/site/view-privacy'], [
    'class'=>'btn btn-danger', 
    'target'=>'_blank', 
    'data-toggle'=>'tooltip', 
    'title'=>'Will open the generated PDF file in a new window'
]); ?>
    </div>
  </div>
  </div>
