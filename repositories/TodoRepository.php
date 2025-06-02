<?php
namespace app\repositories;

use app\models\Todo;

class TodoRepository
{
    public function getByUserId($user_id)
    {
        return Todo::find()->where(["user_id"=>$user_id])->all();
    }

    public function getById($id)
    {
        return Todo::findOne($id);
    }

    public function save (Todo $todo)
    {
        if (!$todo->save()){
            return $todo->errors;
        }
        return $todo;
    }

    public function delete(Todo $todo)
    {
        return $todo->delete();
    }
}