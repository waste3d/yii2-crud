<?php
namespace app\controllers;

use app\models\Todo;
use app\services\TodoService;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;

class TodoController extends Controller
{
    private $todoService;

    public function __construct($id, $module, TodoService $todoService, $config = [])
    {
        $this->todoService = $todoService;
        parent::__construct($id, $module, $config);
    }

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
        $username = Yii::$app->session->get('username');

        if (!$userId) {
            return $this->redirect('/site/login');
        }

        $todos = $this->todoService->getTodosByUserId($userId);

        return $this->render('index', ['todos' => $todos, 'username'=>$username]);
    }

    public function actionView($id)
    {
        $userId = Yii::$app->session->get('user_id');
        $todo = $this->todoService->getTodoById($id, $userId);

        return $this->render('view', ['model'=>$todo]);
    }

    public function actionCreate()
    {
        $userId = Yii::$app->session->get('user_id');
        $errors = null;

        if (Yii::$app->request->isPost) {
            $data = Yii::$app->request->post();
            $result = $this->todoService->createTodo($data, $userId);

            if ($result instanceof Todo) {
                return $this->redirect(['view', 'id' => $result->id]);
            } else {
                $errors = $result;

            }
        }
        return $this->render('create', ['model'=>new Todo(),'errors'=>$errors]);
    }

    public function actionUpdate($id)
    {
        $userId = Yii::$app->session->get('user_id');
        $errors = null;

        if (Yii::$app->request->isPost) {
            $data = Yii::$app->request->post();
            $result = $this->todoService->updateTodo($id, $data, $userId);

            if ($result instanceof Todo) {
                return $this->redirect(['view', 'id' => $result->id]);
            } else {
                $errors = $result;
            }
        }
        $todo = $this->todoService->getTodoById($id, $userId);

        return $this->render('update', [
            'model'=>$todo,
            'errors'=>$errors,
        ]);
    }

    public function actionDelete($id)
    {
        $userId = Yii::$app->session->get('user_id');
        $this->todoService->deleteTodo($id, $userId);

        return $this->redirect(['index']);
    }

}