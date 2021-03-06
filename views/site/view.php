<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use \yii\web\YiiAsset;

/* @var $this yii\web\View */
/* @var $model app\models\Users */

$this->title = $model->name;

//$this->params['breadcrumbs'][] = [
//    'label' => 'Users',
//    'url' => ['index']
//];

$this->params['breadcrumbs'][] = $this->title;

    YiiAsset::register($this);
?>
<div class="users-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Изменить запись', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить запись', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'surname',
            'password',
            'phone',
            'email:email',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
