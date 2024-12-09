<?php

use yii\widgets\ListView;
?>

<?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemView' => '//layouts/template/product/_item',
        'layout' => "{items}",
        'options' => [
          'tag' => false,
        ],
        'itemOptions' => [
            'tag' => false,
        ],
      ]);
?>