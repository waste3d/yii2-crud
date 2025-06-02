<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Login';
?>

<h1>Login</h1>

<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
<?= $form->field($model, 'password')->passwordInput() ?>

<div class="form-group">
    <?= Html::submitButton('Login', ['class' => 'btn btn-primary']) ?>
</div>

<div class="mt-3">
    <span>Don't have an account yet?</span>
    <?= Html::a('Register', ['site/signup'], ['class' => 'btn btn-success ml-2']) ?>
</div>

<?php ActiveForm::end(); ?>
