<?php
$this->title = Yii::t('app', 'Storages');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'CONTENT_MODULE'), 'url' => ['/content']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="storage-index">
    <?= $this->render('//layouts/content/premise/_grid', ['dataProvider' => $dataProvider, 'searchModel' => $searchModel, 'model' => $model]); ?>
</div>
