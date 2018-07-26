<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\Slider1;
use app\models\UploadSlider1Image;
use app\models\Slider1Search;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * Slider1Controller implements the CRUD actions for Slider1 model.
 */
class Slider1Controller extends Controller
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
     * Lists all Slider1 models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new Slider1Search();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Slider1 model.
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
     * Creates a new Slider1 model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Slider1();

        if ($model->load(Yii::$app->request->post())) {
            
            $upload_slider1_image = new UploadSlider1Image();
            
            //загрузка в поле imageFile модели UploadImage экз. класса UploadedFile из формы значения поля upload_image
            $upload_slider1_image->slider1Image = UploadedFile::getInstance($model, 'upload_image');
            
            if ($upload_slider1_image->upload()) {
                
                if($upload_slider1_image->slider1ImageToDb){
                    
                    $model->image = $upload_slider1_image->slider1ImageToDb;
                }
                
                if($model->save()){
                
                    return $this->redirect(['view', 'id' => $model->id]);
                }
                else{
                    print_r($model->errors);
                    die;
                }
            }
            else{
                
                $no_image = 'Должен быть выбран файл для загрузки.';
                
                return $this->render('create', [
                    'model' => $model,
                    'no_image' => $no_image
                ]);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Slider1 model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Slider1 model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        
        if(file_exists('uploads/slider1/'.$model->image)){
            unlink('uploads/slider1/'.$model->image);
        }
        
        $model->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Slider1 model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Slider1 the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Slider1::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
