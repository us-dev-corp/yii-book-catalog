<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Books $model */

$this->title = 'Добавить книгу';
$this->params['breadcrumbs'][] = ['label' => 'Каталог книг', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="books-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
