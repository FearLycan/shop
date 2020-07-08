<?php

use yii\helpers\Url;

?>
<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= Url::to('@web/images/cute_cat_kitten_face.png') ?>" class="img-circle"
                     alt="<?= Yii::$app->user->identity->username ?>"/>
            </div>
            <div class="pull-left info">
                <p><?= Yii::$app->user->identity->username ?></p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget' => 'tree'],
                'items' => [
                    ['label' => 'MAIN NAVIGATION', 'options' => ['class' => 'header']],
                    ['label' => 'Dashboard', 'icon' => 'dashboard', 'url' => ['/admin/dashboard/index'], 'visible' => true],
                    ['label' => 'Stores', 'icon' => 'shopping-bag', 'url' => ['/admin/store/index'], 'visible' => true],
                ],
            ]
        ) ?>

    </section>

</aside>
