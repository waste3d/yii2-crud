<?php
namespace app\controllers;

use app\models\Todo;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;

class TodoController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['*'],
                'rules' => [
                    [
                        'allow' => true,
                    ]
                ]
            ]
        ];
    }

    public function actionIndex()
    {
        $userId = Yii::$app->session->get('user_id');

        if (!$userId){
            return $this->redirect('/site/login');
        }

        $todos = Todo::find()->where(['user_id'=>Yii::$app->session->get("user_id")])->all();
        return $this->render('index', ['todos' => $todos]);
    }
    public function actionView($id)
    {
        return $this->render('view', ['model'=>$this->findModel($id)]);
    }
    public function actionCreate()
    {
        $model = new Todo();
        $model->user_id = Yii::$app->session->get("user_id");

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id'=>$model->id]);
        }
        return $this->render('create', ['model'=>$model]);
    }
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($model->user_id !== Yii::$app->session->get("user_id")) {
            throw new ForbiddenHttpException("Access denied");
        }
        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            return $this->redirect(['view', 'id'=>$model->id]);
        }
        return $this->render('update', ['model'=>$model]);
    }
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        if ($model->user_id === Yii::$app->session->get("user_id")) {
            $model->delete();
        }
        return $this->redirect(['index']);
    }
    protected function findModel($id)
    {
        if(($model = Todo::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested todo does not exist.');
    }
}