<?php
/** @var yii\web\View $this */
/** @var app\models\Todo[] $todos */

use yii\helpers\Html;


$this->title = 'Список задач';
?>
<h1>Hello, <?= Html::encode($username) ?></h1>

<p>
    <?= \yii\helpers\Html::beginForm(['/site/logout'], 'post') ?>
    <?= \yii\helpers\Html::submitButton('Выйти', ['class' => 'btn btn-link']) ?>
    <?= \yii\helpers\Html::endForm() ?>
</p>

<h1><?= Html::encode($this->title) ?></h1>

<p><?= Html::a('Создать задачу', ['create'], ['class' => 'btn btn-success']) ?></p>

<ul>
    <?php foreach ($todos as $todo): ?>
        <li>
            <?= Html::a(Html::encode($todo->title), ['view', 'id' => $todo->id]) ?>
            <?= $todo->status ? '(✔️)' : '(❌)' ?>
        </li>
    <?php endforeach; ?>
</ul>
