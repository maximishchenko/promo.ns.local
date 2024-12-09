<?php

use common\models\NoWrapLinkPager;
?>



<?= NoWrapLinkPager::widget([
  'pagination' => $dataProvider->pagination,
  'disableCurrentPageButton' => false,
  'activePageCssClass' => 'pagination__item--active',
  'disabledPageCssClass' => 'pagination__item--disable',
  'pageCssClass' => 'pagination__item',
  'prevPageCssClass' => 'pagination__item pagination__item--arrow',
  'nextPageCssClass' => 'pagination__item pagination__item--arrow',
  'nextPageLabel' => '<img src="/static/sprite.svg#arrow_n" />',
  'prevPageLabel' => '<img src="/static/sprite.svg#arrow_p" />',
  'options' => [
    'tag' => 'div',
    'class' => 'pagination',
  ],

]); ?>