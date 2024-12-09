<?php if(isset($this->params['breadcrumbs'])): ?>
<div class="bread">
    <div class="container">
    <?= andrewdanilov\breadcrumbs\Breadcrumbs::widget([
        'templateWrapper' => '@frontend/views/layouts/template/breadcrumbs/wrapper', // optional
        'templateItem' => '@frontend/views/layouts/template/breadcrumbs/item', // optional
        'templateActiveItem' => '@frontend/views/layouts/template/breadcrumbs/active-item', // optional
        'showHome' => true, // optional, default true
        'homeLabel' => 'Главная', // optional, default 'Main'
        'homeUrl' => ['/'], // optional, default ['/']
        'microdata' => false, // optional, default false
        'items' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    ]) ?>
    </div>
</div>
<?php endif; ?>