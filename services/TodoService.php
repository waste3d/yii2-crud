<?php
namespace app\services;

use app\models\Todo;
use app\repositories\TodoRepository;
use yii\web\NotFoundHttpException;

class TodoService
{
    private $todoRepository;

    public function __construct()
    {
        $this->todoRepository = new TodoRepository();
    }

    public function getTodosByUserId($user_id)
    {
        return $this->todoRepository->getByUserId($user_id);
    }

    public function getTodoById($id, $user_id)
    {
        $todo = $this->todoRepository->getById($id);
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


        return $this->todoRepository->save($todo);
    }

    public function updateTodo($id, array $data, $user_id)
    {
        $todo = $this->getTodoById($id, $user_id);
        $todo->load($data);

        return $this->todoRepository->save($todo);
    }

    public function deleteTodo($id, $user_id)
    {
        $todo = $this->getTodoById($id, $user_id);
        $this->todoRepository->delete($todo);

    }
}
