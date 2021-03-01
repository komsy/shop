<?php

namespace frontend\controllers;
use Yii;

class MenController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
//Function to add cart
    public function actionProductcart($productId)
    {
        $model = new \frontend\models\Productcart();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                // form inputs are valid, do something here
                return;
            }
        }

        return $this->renderAjax('productcart', [
            'model' => $model,
            'productId' => $productId,
        ]);
    }
    public function actionCartitems($productId)
    {
        $model = new \frontend\models\Cartitems();

        if ($model->load(Yii::$app->request->post())) {
            $model->save();
            return $this->redirect(['men/index']);
        }


        return $this->renderAjax('cartitems', [
            'model' => $model,
            'productId' => $productId,
        ]);
    }
        public function actionAddtocart($productid,$userid,$quantity)
    {
        $checkcart = Productcart::find()->where(['userId'=>$userid])->andWhere(['cartStatus'=>'Active'])->asArray()->one();
        if(empty($checkcart)){
            if($this->createCart($userid,$productid,$quantity)){
                return json_encode('true');
            }
            
        }else {
            $this->createCartItems($checkcart['cartId'],$productid,$quantity);
        }
         
    }
    
    public function createCart($userid,$productid,$quantity){
        $model = New Productcart();
        $data = ['Productcart'=>['userId'=>$userid,'total'=>0,'cartStatus'=>'Active','createdBy'=>yii::$app->user->id]];
        if($model->load($data) && $model->save()){
            $this->createCartItems($model->cartId,$productid,$quantity);
        }
        return false;
    }
    
    public function createCartItems($cartId,$productid,$quantity){
        $model = New Cartitems();
        $data = ['Cartitems'=>['cartId'=>$cartId,'productId'=>$productid,'quantity'=>$quantity]];
        if($model->load($data) && $model->save()){
            return true;
        }
        return false;
    }
}
