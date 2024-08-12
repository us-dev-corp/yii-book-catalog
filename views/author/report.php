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

$this->title = 'Отчет';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="books-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="report-attribute">

        <?php $form = ActiveForm::begin([
            'method' => 'get',
            'action' => ['report'],
        ]); ?>

        <?= Html::textInput('year', '', ['class' => 'form-control', 'placeholder' => 'Год выпуска']) ?>

        <div class="form-group">
            <?= Html::submitButton('Сформировать', ['class' => 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>

    <?php if ($dataProvider) { ?>
        <?= ListView::widget([
             'dataProvider' => $dataProvider,
             'itemView' => '_author_item',
             'layout' => "{items}\n{pager}",
         ]); ?>
    <?php } ?>
</div>
