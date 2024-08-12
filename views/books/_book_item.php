<?php

use yii\helpers\Html;
use yii\helpers\Url;
use app\models\Authors;


/* @var $model app\models\Books */
?>

<div class="book-item">
    <div class="book-thumbnail">
        <?= Html::img($model->photo, ['alt' => $model->title, 'width' => '100px']) ?>
    </div>
    <div class="book-details">
        <h3><a href="<?=Url::toRoute(['view', 'id' => $model->id])?>"><?= Html::encode($model->title) ?></a></h3>
        <p><strong>Год издания:</strong> <?= Html::encode($model->year) ?></p>
        <p><?= Html::encode($model->description) ?></p>
        <?php
        $authors = [];
        if ($model->authors) {
            foreach ($model->authors as $author) {
                $authors[] = '<a href="' . Url::toRoute(['/author/view', 'id' => $author->id]) . '">' . $author->fullName . '</a>';
            }
        }
        ?>
        <?php if (!empty($authors)) { ?>
            <p><?=count($authors) > 1 ? 'Авторы: ' : 'Автор: '; ?> <?=implode(', ', $authors)?></p>
        <?php } ?>
    </div>
</div>
<hr>