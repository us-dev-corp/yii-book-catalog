<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\web\JsExpression;
use yii\widgets\MaskedInput;

/** @var yii\web\View $this */
/** @var app\models\Authors $model */
/** @var bool $subscriptionAvailability */

$this->title = $model->fullName;
$this->params['breadcrumbs'][] = ['label' => 'Авторы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="books-view">

    <h1><?= Html::encode($this->title) ?></h1>


    <?= DetailView::widget([
       'model' => $model,
       'attributes' => [
           'surname',
           'name',
           'patronymic',
       ],
   ]) ?>

    <?php
    if (Yii::$app->user->isGuest) {
        if (!Yii::$app->request->cookies->getValue('phone')) {
            echo MaskedInput::widget(
                [
                    'name' => 'phone',
                    'mask' => '+7 (999) 999-99-99',
                    'options' => [
                        'class' => 'form-control',
                        'id' => 'phone-input',
                        'placeholder' => '+7 (___) ___-__-__',
                    ],
                ]
            );
        }
        $btnText = $subscriptionAvailability ? 'Отписаться' : 'Подписаться';
        echo Html::hiddenInput('author_id', $model->id, ['id' => 'author-id']);
        echo Html::button($btnText, ['class' => 'btn btn-success', 'id' => 'subscribe-button']);

        $this->registerJs(
            new JsExpression(
            "$('#subscribe-button').on('click', function() {
                let phone;
                if (getCookie('phone')) {
                    phone = getCookie('phone');
                } else {
                    phone = $('#phone-input').val();
                }
                
                let author = $('#author-id').val();
                if (phone) {
                    if (!getCookie('phone')) {
                        document.cookie = 'phone=' + phone;
                        $('#phone-input').hide();
                    }
    
                    $.ajax({
                        url: '" . \yii\helpers\Url::to(['author/subscribe']) . "',
                        type: 'POST',
                        data: {phone: phone, author: author},
                        dataType: 'json',
                        success: function(response) {
                            if (response.success) {
                                alert(response.message);
                                let btn = document.getElementById('subscribe-button');
                                if (response.action === 'subscribe') {
                                    btn.innerText = 'Отписаться';
                                } else {
                                    btn.innerText = 'Подписаться';
                                }
                            } else {
                                alert('Произошла ошибка, попробуйте снова.');
                            }
                        }
                    });
                } else {
                    alert('Введите номер телефона.');
                }
            });
        "));
    }
    ?>
</div>
