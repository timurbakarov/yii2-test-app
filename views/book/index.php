<?php

use app\models\Book;
use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Books';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="book-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Book', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php $form = \yii\bootstrap\ActiveForm::begin([
        'action' => \yii\helpers\Url::toRoute(''),
        'method' => 'get',
        'options' => [
            'role' => 'form',
            'style' => 'margin: 10px 0;',
        ]
    ]);

    $model = new \app\models\BookSearch($params);

    ?>

        <div class="row">
            <div class="col-lg-3">
                <?=$form->field($model, 'author_id')
                    ->dropDownList(['Автор'] + \app\models\Author::options())
                    ->label(false)?>
            </div>
            <div class="col-lg-3">
                <?=$form->field($model, 'name')->textInput([
                    'placeholder' => 'Название книги',
                ])->label(false)?>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-2">
                Дата выхода книги:

            </div>
            <div class="col-lg-3">
                <?=$form->field($model, 'dateFrom')->textInput([
                    'placeholder' => '31/12/2014',
                ])->label(false)?>
            </div>
            <div class="col-lg-3">
                <?=$form->field($model, 'dateTo')->textInput([
                    'placeholder' => '31/02/2015',
                ])->label(false)?>

            </div>
            <div class="col-lg-1 col-lg-offset-1">
                <a href="<?=\yii\helpers\Url::to(['index'])?>" class="btn btn-default">
                    Сбросить
                </a>
            </div>
            <div class="col-lg-1 col-lg-offset-1">
                <input type="submit" name="submit" value="Искать" class="btn btn-default">
            </div>
        </div>

        <input type="hidden" name="r" value="book/index">
    <?php \yii\bootstrap\ActiveForm::end()?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
            'name',
            [
                'attribute' => 'preview',
                'content' => function(Book $data) {
                    return Html::a(
                        Html::img($data->previewThumbWebPath()),
                        $data->previewWebPath(),
                        [
                            'data-lightbox' => "image-" . $data->id,
                            'data-title' => $data->name
                        ]
                    );
                },
                'filter' => false,
            ],
            [
                'attribute' => 'author_id',
                'content' => function($data) {
                    return $data->author->fullName;
                }
            ],
            [
                'attribute' => 'date',
                'content' => function($data) {
                    return Yii::$app->formatter->asDate(new DateTime($data->date));
                },
            ],
            [
                'attribute' => 'date_create',
                'content' => function($data) {
                    return Yii::$app->formatter->asDate(new DateTime($data->date_create));
                },
            ],

            [
                'class' => 'yii\grid\ActionColumn',
            ],
        ],
    ]); ?>

</div>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Просмотр</h4>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
            </div>
        </div>
    </div>
</div>