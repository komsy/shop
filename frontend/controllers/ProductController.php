<?php

namespace frontend\controllers;

use common\xyz\MpesaApi;
use Yii;
use frontend\models\Product;
use frontend\models\ProductSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use frontend\models\Productimages;
use yii\web\UploadedFile;
use frontend\models\Productcart;
use frontend\models\Cartitems;
use frontend\models\Productbrand;
use frontend\models\Productuom;
use frontend\models\Productcolor;
use frontend\models\Orders;
use frontend\models\Orderitems;

/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Product models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Product model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */

     public function actionCreate()
    {
        $model = new Product();
        $image= new Productimages();
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if($this->saveImage($model->productId,Yii::$app->request->post()['Productimages'])){
                return $this->redirect(['view', 'id' => $model->productId]);
            }
        }
        return $this->render('create', [
            'model' => $model,
            'image'=>$image
        ]);
    }
    
    /**
     * 
     * @param  $productId
     * @param  $imagedata
     */
    public function saveImage($productId,$imagedata){
        
        $model = new Productimages();
                
        if($model->load(["Productimages"=>['imagePath'=>$imagedata['imagePath']]]))
        {
        //generates images with unique names
        $imageName = bin2hex(openssl_random_pseudo_bytes(10));
        $model->imagePath = UploadedFile::getInstance($model, 'imagePath');
        //saves file in the root directory
         $model->imagePath->saveAs('uploads/'.$imageName.'.'.$model->imagePath->extension);
       //save in the db
            $model->imagePath='uploads/'.$imageName.'.'.$model->imagePath->extension;
            $model->productId = $productId;
            if($model->save()){
                return true;
            }
        }
        return false;
    }


    public function actionProductbrand()
    {
        $model = new \frontend\models\Productbrand();

        if ($model->load(Yii::$app->request->post())) {

           $model->save();
            return $this->redirect(['product/create']);
        }

        return $this->renderAjax('productbrand', [
            'model' => $model,
        ]);
    }
    public function actionProductcolor()
    {
        $model = new \frontend\models\Productcolor();

        if ($model->load(Yii::$app->request->post())) {

           $model->save();
            return $this->redirect(['product/create']);
        }

        return $this->renderAjax('productcolor', [
            'model' => $model,
        ]);
    }
    public function actionProductcategory($productId)
    {
        $model = new \frontend\models\ProductCategory();

        if ($model->load(Yii::$app->request->post())) {

           $model->save();
            return $this->redirect(['site/index']);
        }

        return $this->render('productcategory', [
            'model' => $model,
            'productId' => $productId,
        ]);
    }
    public function actionCategories()
    {
        $model = new \frontend\models\Categories();

        if ($model->load(Yii::$app->request->post())) {

           $model->save();
            return $this->redirect(['product/create', 'categoryId' => $model->categoryId]);
        }

        return $this->renderAjax('categories', [
            'model' => $model,
        ]);
    }

    public function actionProductuom()
    {
        $model = new \frontend\models\Productuom();

        if ($model->load(Yii::$app->request->post())) 
        {
        $model->save();
        return $this->redirect(['product/create']);
      
          }

        return $this->renderAjax('productuom', [
            'model' => $model,
        ]);
    }
    public function actionCheckout()
    {
        return $this->render('checkout');
    }

    public function actionProfile()
    {
        $model = new \frontend\models\Profile();

        if ($model->load(Yii::$app->request->post())) 
        {
            $model->save();
            // form inputs are valid, do something here
            return $this->redirect(['product/checkout']);
            return $this->redirect([ 'addimage','id' => $model->listingId]);
            
        }

        return $this->render('profile', [
            'model' => $model,
        ]);
    }
    public function actionDelivery()
    {
        $model = new \frontend\models\Delivery();

        if ($model->load(Yii::$app->request->post())) 
            {
        $model->save();
        return $this->redirect(['product/create']);
      
          }

        return $this->renderAjax('delivery', [
            'model' => $model,
        ]);
    }
/*    public function actionPayment()
    {
        $model = new \frontend\models\Paymentmethods();

        if ($model->load(Yii::$app->request->post())) {
        $model->save();
        return $this->redirect(['product/create']);
      
          }
        return $this->render'payment', [
            'model' => $model,
        ]);
    }*/
    public function actionMethods()
    {
        $model = new \frontend\models\Paymentmethods();

        if ($model->load(Yii::$app->request->post())) {
        $model->save();
        return $this->redirect(['product/create']);
      
          }
        return $this->renderAjax('methods', [
            'model' => $model,
        ]);
    }
        /**
     * 
     * @return string
     */
    
    public function actionCart()
    {
        return $this->render('cart');
    }

    public function actionAddtocart($productid,$userid,$quantity)
    {
        $checkcart = Productcart::find()->where(['userId'=>$userid])->andWhere(['cartStatus'=>'Active'])->asArray()->one();
        if(empty($checkcart)){ //checks if productcart is empty and passess the data below to function createcart
            if($this->createCart($userid,$productid,$quantity)){
                return json_encode('true');
            }
            
        }else { //if not empty it passes this data below
            $this->createCartItems($checkcart['cartId'],$productid,$quantity);
        }
         
    }
    public function createCart($userid,$productid,$quantity){
        $model = New Productcart();
        $data = ['Productcart'=>['userId'=>$userid,'quantity'=>$quantity,'cartStatus'=>'Active','createdBy'=>yii::$app->user->id]];
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

    public function actionListing()
        {
            return $this->render('listing');
        }
    
    public function actionAddcartitems()
    {
        $model = new \frontend\models\Cartitems();

        if ($model->load(Yii::$app->request->post())) 
        {
        $model->save();
        return $this->redirect(['men/index']);
      
        }

        return $this->render('addcartitems', [
            'model' => $model,
        ]);
    }
 public function actionAck()
    {
        return $this->render('ack');
    }
        /**
     * Updates an existing Product model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->productId]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Product model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    
    /** Mpesa intergration
     *
     * @return void|unknown
     */
    public function actionDeposit()
    {
        $model = new \frontend\models\Deposit();
        
        if (\Yii::$app->request->post()) {
            $response = $this->pay(\Yii::$app->request->post()['Deposit']);
            $this->processRespose($response,\Yii::$app->request->post());

        return $this->redirect(['product/ack']);
        }
        
        return $this->render('deposit', [
            'model' => $model,
        ]);
    }

    public function pay($postData){
        $mpesa_api = new MpesaApi();
       // var_dump($postData); exit();
        $TransactionType = 'CustomerPayBillOnline';
        $Amount = $postData['transAmount'];
        $PhoneNumber = $postData['phoneCode'].$postData['mpesaNumber'];
        $PartyA = $postData['phoneCode'].$postData['mpesaNumber'];
        $PartyB = 174379;
     //   $UserId = $postData['userId'];
        $CallBackURL = 'https://a41737270d1c.ngrok.io/shop/xyz/confirm?token=KUstudents51234567qwerty';
        $AccountReference =  '3Wies';
        $TransactionDesc = '3Wies';
        
        
        
        $configs = array(
            'AccessToken' => $this->generateToken(),
            'Environment' => 'sandbox',
            'Content-Type' => 'application/json',
            'Verbose' => 'true',
        );
        
        $api = 'stk_push';
        $LipaNaMpesaPasskey= 'bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919';
        $timestamp ='20'.date("ymdhis");
        $BusinessShortCode = 174379;
        
        $parameters = array(
            'BusinessShortCode' => $BusinessShortCode,
            'Password' => base64_encode($BusinessShortCode.$LipaNaMpesaPasskey.$timestamp),
            'Timestamp' => $timestamp,
            'TransactionType' => $TransactionType,
            'Amount' => $Amount,
            'PartyA' => $PartyA,
            'PartyB' => $PartyB,
            'PhoneNumber' =>$PhoneNumber,
            'CallBackURL' => $CallBackURL,
            'AccountReference' => $AccountReference,
            'TransactionDesc' => $TransactionDesc,
        );
        
        $response = $mpesa_api->call($api, $configs, $parameters);
        return $response;
    }
    
    
    private function generateToken(){
        
        $mpesa_api = new MpesaApi();
        
        $configs = array(
            'Environment' => 'sandbox',
            'Content-Type' => 'application/json',
            'Verbose' => '',
        );
        
        $api = 'generate_token';
        
        $parameters = array(
            'ConsumerKey' => 'ITWg7obHCx5JDkvL7QwmJ5czvWB8EtqU',
            'ConsumerSecret' => 'zxhDdSRGi208JYZo',
        );
        
        $response = $mpesa_api->call($api, $configs, $parameters);
        return $response['Response']['access_token'];
        
    } 
    public function processRespose($response,$postData) {
        $model = new \frontend\models\Deposit();
        if (array_key_exists('errorCode', $response['Response'])) {
            $model->load($postData);
            $model->save();
            $Msg = '<div class="alert alert-danger alert-dismissable" role="alert">
                    <h3>THE FOLLOWING ERROR HAS ACCURED WHILE TRYING TO PROCESS YOUR REQUEST</h3>
                     <h5> ERROR CODE: '.$response['Response']['errorCode'].'</h5>
                     <h6>'.$response['Response']['errorMessage'].'</h6><h6>For more information Please Contact Support Via: 0704081087</h6>
                    </div>';
            \Yii::$app->session->setFlash('error', $Msg);
            $this->redirect(['site/index']);
        }else{
            $model->load($postData);
            if (array_key_exists('MerchantRequestID', $response['Response'])) {
                $model->MerchantRequestId = $response['Response']['MerchantRequestID'];
                $this->saveRequestData($response,$postData['Deposit']['orderId']);
            }
            $model->save();
            $Msg = '<div class="alert alert-success alert-dismissable" role="alert">
                            <h5> '.$response['Response']['CustomerMessage'].'</h5>
                          </div>';
            \Yii::$app->session->setFlash('success', $Msg);
            $this->redirect(['site/index']);
        }
    }
   
    public function saveRequestData($response,$orderId){
        
        $model = new \frontend\models\MpesaStkRequests();
        
        $model->amount = $response['Parameters']['Amount'];
        $model->phone = $response['Parameters']['PhoneNumber'];
        $model->reference = $response['Parameters']['AccountReference'];
        $model->description = $response['Parameters']['TransactionDesc'];
        $model->CheckoutRequestID = $response['Response']['CheckoutRequestID'];
        $model->MerchantRequestID = $response['Response']['MerchantRequestID'];
        $model->orderId = $orderId;
        $model->userId = \yii::$app->user->Id;
        
        $model->save();
        
        return $model;  
    }

 /*   public function actionAddorder($productid,$total)
    {
        $model = new \frontend\models\Orders();

        if ($model->load(Yii::$app->request->post())) {
            $model->save();
            return $this->redirect(['product/checkout']);
            }
        return $this->renderAjax('addorder', [
            'model' => $model,
            'productId' => $productId,
            'total' => $total,
        ]);
    }*/
        public function actionAddorder($productid,$userid,$total)
    {
        $checkorder = Orders::find()->where(['userId'=>$userid])->andWhere(['orderStatus'=>'New'])->asArray()->one();
        if(empty($checkorder)){
            if($this->createorder($userid,$productid,$total)){
                return json_encode('true');
            }
            
        }else {
            $this->createOrderItems($checkorder['orderId'],$productid,$total);
        }
         
    }
    
    public function createOrder($userid,$productid,$total){
        $model = New Orders();
        $data = ['Orders'=>['userId'=>$userid,'total'=>$total,'orderStatus'=>'New','createdBy'=>yii::$app->user->id]];
        if($model->load($data) && $model->save()){
            $this->createorderItems($model->orderId,$productid,$total);
        }
        return false;
    }
    
    public function createOrderitems($orderId,$productid){
        $model = New Orderitems();
        $data = ['Orderitems'=>['orderId'=>$orderId,'productId'=>$productid]];
       
        if($model->load($data) && $model->save()){
            return $this->redirect(['product/deposit']);
        }
        return false;
    }    
 
}
