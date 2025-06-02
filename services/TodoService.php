<?php
namespace app\services;

use app\models\Todo;
use yii\web\NotFoundHttpException;

class TodoService
{
    public function getTodosByUserId($user_id)
    {
        return Todo::find()->where(["user_id"=>$user_id])->all();
    }

    public function getTodoById($id, $user_id)
    {
        $todo = Todo::findOne($id);
        if (!$todo) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }

        if ($todo->user_id !== $user_id) {
            throw new NotFoundHttpException('Access denied.');
        }

        return $todo;
    }

    public function createTodo(array $data, $user_id)
    {
        $todo = new Todo();
        $todo -> user_id = $user_id;
        $todo->load($data);

        if (!$todo->save()) {
            return $todo->errors;
        }

        return $todo;
    }

    public function updateTodo($id, array $data, $user_id)
    {
        $todo = $this->getTodoById($id, $user_id);
        $todo->load($data);

        if (!$todo->save()) {
            return $todo->errors;
        }
        return $todo;
    }

    public function deleteTodo($id, $user_id)
    {
        $todo = $this->getTodoById($id, $user_id);
        return $todo->delete();
    }
}
