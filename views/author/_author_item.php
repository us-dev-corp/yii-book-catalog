<?php

use yii\helpers\Html;
use yii\helpers\Url;
use app\models\Authors;

/* @var $model app\models\Authors */
?>

<div class="author-item">
    <div class="author-details">
        <h3><?=$index + 1?>. <a href="<?=Url::toRoute(['view', 'id' => $model->id])?>"><?= Html::encode($model->fullName) ?></a></h3>
    </div>
</div>
<hr>