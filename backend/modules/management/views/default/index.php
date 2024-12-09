<?php

$this->title = Yii::t('app', 'MANAGEMENT_MODULE');
$this->params['breadcrumbs'][] = $this->title;
?>
<?= $this->render('//layouts/dashboard/_management_dashboard_items'); ?>