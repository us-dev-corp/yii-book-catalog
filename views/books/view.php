<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Books $model */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Каталог книг', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="books-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (!Yii::$app->user->isGuest) { ?>
        <p>
            <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Вы действительно хотите удалить книгу?',
                    'method' => 'post',
                ],
            ]) ?>
        </p>
    <?php } ?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'title',
            [
                'attribute'=>'photo',
                'value'=>$model->photo,
                'format' => ['image',['width'=>'100']],
            ],
            'year',
            'description:ntext',
            'isbn',
        ],
    ]) ?>

</div>
