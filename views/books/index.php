<?php

use app\models\Books;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\ListView;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\BooksSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Каталог кинг';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="books-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (!Yii::$app->user->isGuest) { ?>
        <p>
            <?= Html::a('Добавить книгу', ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    <?php } ?>

    <div class="books-search">

        <?php $form = ActiveForm::begin([
            'method' => 'get',
            'action' => ['index'],
        ]); ?>

        <?= $form->field($searchModel, 'title')->textInput(['placeholder' => 'Название книги'])->label(false) ?>
        <?= $form->field($searchModel, 'year')->textInput(['placeholder' => 'Год издания'])->label(false) ?>

        <div class="form-group">
            <?= Html::submitButton('Найти', ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Сбросить фильтр', ['index'], ['class' => 'btn btn-outline-secondary']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>

    <?= ListView::widget([
         'dataProvider' => $dataProvider,
         'itemView' => '_book_item',
         'layout' => "{items}\n{pager}",
     ]); ?>

</div>
