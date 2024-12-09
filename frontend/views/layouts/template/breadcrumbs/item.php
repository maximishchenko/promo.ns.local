<?php

/* @var $this \yii\web\View */
/* @var $label string */
/* @var $url string|array */
/* @var $microdata bool */
/* @var $position int */

use yii\helpers\Url;

?>

<a class= "bread__link" href="<?= Url::to($url) ?>">
	<?= $label ?>
</a>
