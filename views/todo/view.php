<?php
/** @var yii\web\View $this */
/** @var app\models\Todo $model */

use yii\helpers\Html;

$this->title = $model->title;
?>

<h1><?= Html::encode($this->title) ?></h1>

<p><strong>Описание:</strong> <?= Html::encode($model->content) ?></p>
<p><strong>Статус:</strong> <?= $model->status ? 'Выполнено' : 'Не выполнено' ?></p>

<p>
    <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-warning']) ?>
    <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
        'class' => 'btn btn-danger',
        'data' => ['confirm' => 'Удалить задачу?', 'method' => 'post'],
    ]) ?>
    <?= Html::a('Вернуться к списку', ['todo/index'], ['class' => 'btn btn-primary']) ?>
</p>
