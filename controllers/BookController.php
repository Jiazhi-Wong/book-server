<?php

namespace app\controllers;

use Yii;
use app\models\Book;
use app\models\BookSearch;
use yii\data\Pagination;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * BookController implements the CRUD actions for Book model.
 */
class BookController extends Controller
{
    public $enableCsrfValidation = false;

    /**
     * @inheritdoc
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
     * Lists all Book models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BookSearch();
        $dataQuery = $searchModel->search(Yii::$app->request->queryParams);

//        $count = $dataQuery->count();
//        $pagination = new Pagination([
//            'defaultPageSize' => 10,
//            'totalCount' => $count,
//        ]);

        $data = $dataQuery->all();

        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;
        return [
            'code' => 0,
            'msg' => 'success',
            'data' => [
                'list' => $data,
            ]
        ];
    }

    /**
     * Displays a single Book model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;
        return [
            'code' => 0,
            'msg' => 'success',
            'data' => $this->findModel($id)
        ];
    }

    /**
     * Creates a new Book model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Book();

        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return [
                'code' => 0,
                'msg' => 'success',
                'data' => [
                    'id' => $model->book_id
                ]
            ];
        }

        return [
            'code' => -1,
            'msg' => 'error',
        ];
    }

    /**
     * Updates an existing Book model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return [
                'code' => 0,
                'msg' => 'success',
                'data' => [
                    'id' => $model->book_id
                ]
            ];
        }

        return [
            'code' => -1,
            'msg' => 'error',
        ];
    }

    /**
     * Deletes an existing Book model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;

        return [
            'code' => 0,
            'msg' => 'success',
        ];
    }

    /**
     * Finds the Book model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Book the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Book::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
