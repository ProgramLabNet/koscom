<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\Articles;
use app\models\ArticlesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\UploadImage;
use yii\web\UploadedFile;
use app\models\Categories;

/**
 * ArticlesController implements the CRUD actions for Articles model.
 */
class ArticlesController extends Controller
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
     * Lists all Articles models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ArticlesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Articles model.
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
     * Creates a new Articles model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Articles();
        
        $categories = new Categories();
        $arr_categories = $categories->getWhithOutChildrenId();
        
        $this->LoadAndSaveModel($model);

        return $this->render('create', [
            'model' => $model,
            'arr_categories' => $arr_categories,
        ]);
    }
    
    
    public function LoadAndSaveModel($model){
        
        $upload_image_model = new UploadImage();
        
        if ($model->load(Yii::$app->request->post())){
            //оборачивание в тег <p> со стилем style="text-align:justify"
            if($model->lead){
                $str = $model->lead;
                $find = '<p style="text-align:justify">';
                
                $pos = strpos($str, $find);
                if($pos === FALSE){
                   $model->lead = '<p style="text-align:justify">'.$model->lead.'</p>'; 
                }   
            }
            //заполнение полей created_at или updated_at в зависимости новая ли запись
            if($model->isNewRecord){
                $model->created_at = date('Y-m-d H:i:s');
            }
            else{
                $model->updated_at = date('Y-m-d H:i:s');
            }
            //загрузка в поле imageFile модели UploadImage экз. класса UploadedFile из формы значения поля upload_image
            $upload_image_model->imageFile = UploadedFile::getInstance($model, 'upload_image');

            $upload_image_model->previewImageFile = UploadedFile::getInstance($model, 'upload_preview_image');

            if ($upload_image_model->upload()) {
                if($upload_image_model->imageFileToDb){
                     $model->main_image = $upload_image_model->imageFileToDb;
                }
                if($upload_image_model->previewImageFileToDb){
                    $model->preview_image = $upload_image_model->previewImageFileToDb;
                }
            }

            if($model->save()){
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }
        return;
    }
    

    /**
     * Updates an existing Articles model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        
        $categories = new Categories();
        $arr_categories = $categories->getWhithOutChildrenId();

        $this->LoadAndSaveModel($model);

        return $this->render('update', [
            'model' => $model,
            'arr_categories' => $arr_categories,
        ]);
    }

    /**
     * Deletes an existing Articles model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        
        if(file_exists('uploads/'.$model->main_image)){
            unlink('uploads/'.$model->main_image);
        }
        
        if(file_exists('uploads/preview/'.$model->preview_image)){
            unlink('uploads/preview/'.$model->preview_image);
        }
        
        $model->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Articles model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Articles the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Articles::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
