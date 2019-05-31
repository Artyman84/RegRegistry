<?php

use app\models\Users;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Users */
/* @var $form ActiveForm */

?>

<div class="row">
    <div class="col-sm-12 text-center">
        <h1>Регистрация пользователя</h1>
    </div>
</div>

<?php $form = ActiveForm::begin([
        'fieldConfig' => [
            'template' => '<div class="row"><div class="col-sm-12">{label}{input}{error}</div></div>',
            'labelOptions' => ['class' => 'control-label'],
        ]
]); ?>
    <?= $form->field($model, 'user_type')->radioList(['Физическое лицо', 'Юридическое лицо'], ['class' => 'text-center js-user-type'])->label(false) ?>
    <?= $form->field($model, 'name') ?>
    <?= $form->field($model, 'surname') ?>
    <?= $form->field($model, 'patronymic') ?>
    <?= $form->field($model, 'email')->input('email') ?>
    <?= $form->field($model, 'inn') ?>
    <?= $form->field($model, 'company', ['options' => ['style' => 'display:none']]) ?>

    <div class="form-group">
        <div class="row">
            <div class="col-md-12">
                <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
            </div>
        </div>
    </div>

<?php ActiveForm::end(); ?>


