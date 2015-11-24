<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

?>

<h1><?= Html::encode($this->title) ?></h1>

<?= DetailView::widget([
    'model' => $model,
    'attributes' => [
        'id',
        'name',
        [
            'attribute' => 'date_create',
            'value' => Yii::$app->formatter->asDate(new DateTime($model->date_create)),
        ],
        [
            'attribute' => 'date_update',
            'value' => Yii::$app->formatter->asDate(new DateTime($model->date_update)),
        ],
        [
            'attribute' => 'preview',
            'format' => 'raw',
            'value' => Html::a(
                Html::img($model->previewThumbWebPath()),
                $model->previewWebPath(),
                [
                    'data-lightbox' => "image-" . $model->id,
                    'data-title' => $model->name
                ]
            )
        ],
        [
            'attribute' => 'date',
            'value' => Yii::$app->formatter->asDate(new DateTime($model->date))
        ],
        [
            'attribute' => 'author_id',
            'value' => $model->author->fullName
        ],
    ],
]) ?>