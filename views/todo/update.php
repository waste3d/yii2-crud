<?php

/** @var yii\web\View $this */
/** @var app\models\Todo $model */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = $model->isNewRecord ? 'Создать задачу' : 'Редактировать задачу';
?>

<h1><?= Html::encode($this->title) ?></h1>

<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'title')->textInput() ?>
<?= $form->field($model, 'content')->textarea() ?>
<?= $form->field($model, 'status')->checkbox() ?>

<div class="form-group">
    <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
</div>

<?php ActiveForm::end(); ?>
<?php
