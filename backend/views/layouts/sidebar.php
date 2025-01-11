<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= Yii::$app->homeUrl; ?>" class="brand-link">
        <span class="brand-text font-weight-light">
            <?= Yii::$app->name; ?>
        </span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <?php
            echo \hail812\adminlte\widgets\Menu::widget([
                'items' => [
                    
                    
                    ['label' => Yii::t('app', 'Modules Menu Link'), 'header' => true],
                    ['label' => Yii::t('app', 'Management Menu Link'), 'url' => ['/management'], 'iconStyle' => 'far', 'iconClassAdded' => 'text-danger'],
                    ['label' => Yii::t('app', 'Catalog Menu Link'), 'url' => ['/catalog'], 'iconStyle' => 'far', 'iconClassAdded' => 'text-success'],
                    ['label' => Yii::t('app', 'Content Menu Link'), 'url' => ['/content'], 'iconClass' => 'nav-icon far fa-circle text-warning'],
                    ['label' => Yii::t('app', 'SEO Menu Link'), 'url' => ['/seo'], 'iconStyle' => 'far', 'iconClassAdded' => 'text-info'],
                    
                    
                    ['label' => Yii::t('app', 'Development Tools'), 'header' => true],
                    ['label' => 'Login', 'url' => ['site/login'], 'icon' => 'sign-in-alt', 'visible' => Yii::$app->user->isGuest],
                    ['label' => 'Gii',  'icon' => 'file-code', 'url' => ['/gii'], 'target' => '_blank'],
                    ['label' => 'Debug', 'icon' => 'bug', 'url' => ['/debug'], 'target' => '_blank'],
                    
                ],
            ]);
            ?>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>