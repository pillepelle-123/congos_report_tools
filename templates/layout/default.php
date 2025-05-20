<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 * @var \App\View\AppView $this
 */

use Cake\Routing\Router;

use function PHPUnit\Framework\isEmpty;

$cakeDescription = 'Congos Report Tools';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <!-- fontawesome -->
    <link href="/fontawesome/css/fontawesome.css" rel="stylesheet" />
    <link href="/fontawesome/css/solid.css" rel="stylesheet" />
    <link href="/fontawesome/css/regular.css" rel="stylesheet" />
    <link href="/fontawesome/css/brands.css" rel="stylesheet" />

    <?= $this->Html->css(['normalize.min', 'milligram.min', 'fonts', 'cake']) ?>



</head>
<body>
    <div class="top-nav-container">
        <nav class="top-nav">
            <div class="top-nav-title">
                <?= $this->Html->image('icons/crt_ffffff.svg', array('title' => 'Congos Report Tools', 'url' => '/')) ?>
               <!--<a href="<? /*= $this->Url->build('/') */?>"><span>C</span>ongos <span>R</span>eport <span>T</span>ools</a> -->
            </div>
            <div class="top-nav-links">

                <?php if ($this->Identity->isLoggedIn()): ?>
                    <ul id="user-menu">
                        <li><i class="fa-solid fa-user"></i>&nbsp;
                        <?php echo $this->Identity->get('username'); ?></li>
                        <li><?php echo $this->Html->link('Logout', url: ['controller' => 'Users', 'action' => 'logout']); ?></li>
                        <li>
                            <?php  /*$this->Html->link(
                        $user->username, //$this->Avatar->display($user),
                        ['controller' => 'Users', 'action' => 'edit', $user->id],
                        ['escape' => false]) */ ?>
                        </li>
                    </ul>
                    
                <?php endif; ?>  
                
            </div>
            
        </nav>
    </div>
    <div class="breadcrumb-container">
        <div class="left">
        <ul class="breadcrumb-container-list" id="breadcrumb">
    <?php $secondLastCrumb = null; ?>
    <?php foreach ($breadcrumbs as $i => $crumb): ?>
        <?php
            $total = count($breadcrumbs);
            $isFirst = $i === 0;
            $isLast = $i === $total - 1;
            $isSecondLast = $i === $total - 2;
            $isCollapsible = !$isFirst && !$isLast && $total > 3;
            if ($isSecondLast) {
                $secondLastCrumb = $crumb;
            }
        ?>

        <?php if ($i === 1 && $total > 3): ?>
            <li class="breadcrumb-toggle" title="Ausklappen" onclick="toggleBreadcrumb(this)"><i class="fa-solid fa-circle-plus" style="margin-right: 6px;"></i></li>
        <?php endif; ?>

        <li class="breadcrumb-container-item<?= $isCollapsible ? ' collapsed' : '' ?><?= $isLast ? ' breadcrumb-container-item-last' : '' ?>"
            <?= $isCollapsible ? 'data-collapsible="true"' : '' ?>>
            <?php // $lastCrumb = $crumb; ?>
            <?= $isLast
                ? h($crumb->title)
                : $this->Html->link($crumb->title, [
                    'plugin' => $crumb->plugin,
                    'controller' => $crumb->controller,
                    'action' => $crumb->action
                ]) ?>
        </li>
    <?php endforeach; ?>
    <li class="breadcrumb-collapse-control hidden" title="Einklappen" onclick="toggleBreadcrumb(this)"><i class="fa-solid fa-circle-minus"></i></li>
</ul>      
</div> 
                <div class="right">      
                <?php
                if ($secondLastCrumb) {
                    $lastPageTitle = $secondLastCrumb->title;
                    $lastPageLink = [
                        'plugin' => $secondLastCrumb->plugin,
                        'controller' => $secondLastCrumb->controller,
                        'action' => $secondLastCrumb->action
                    ];
                    echo $this->Html->image('icons/material_arrow_circle_back_292929.svg', array('title' => $lastPageTitle, 'url' => $lastPageLink, isset($sessionData) ? $sessionData : ''));
                }
                //  $this->Html->link($lastCrumb->title, [
                //     'plugin' => $crumb->plugin,
                //     'controller' => $crumb->controller,
                //     'action' => $crumb->action
                // ])
                
                // if ($info['template'] !== 'home') {
                // echo $this->Html->image('icons/material_arrow_circle_back_292929.svg', array('title' => $lastPageTitle, 'url' => $lastPageLink, isset($sessionData) ? $sessionData : ''));
                // }
                ?>
                <!-- REPORT -->
                 <?php /*
                    <?php if (!empty($report)): ?>
                        <?php echo h($report->report_name) . '&nbsp;';
                        echo $this->Html->image('icons/material_view.svg', array('title' => 'Report', 'height' => '16', 'width' => '16'));
                        ?>
                    <?php endif; ?>
                    */ ?>

                </div>       

        <?php /*
    <nav aria-label="breadcrumb">
        <ol>
            <?php foreach ($breadcrumbs as $crumb): ?>
                <li class="breadcrumb-container-item <?= empty($crumb->url) ? 'active' : '' ?>">
                    <?= empty($crumb->url) ? $crumb->title : $this->Html->link($crumb->title, $crumb->url) ?>
                </li>
            <?php endforeach; ?>
        </ol>
    </nav>
    */ ?>
        </div>
    </div>
        <!-- Breadcrumb Navi eingebunden, s. element\breadcrumb.php -->
        <?php // $this->element('breadcrumb'/*, ['user' => $user]*/) ?>
        <?php /*
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <?php foreach ($breadcrumbs as $crumb): ?>
                    <li class="breadcrumb-container-item <?= empty($crumb->url) ? 'active' : '' ?>">
                        <?= empty($crumb->url) ? $crumb->title : $this->Html->link($crumb->title, $crumb->url) ?>
                    </li>
                <?php endforeach; ?>
            </ol>
        </nav>
        */ ?> 
        <?php /*
        <?php if (!empty($breadcrumbs)): ?>
            <nav class="breadcrumb-nav">
                <ul class="breadcrumb">
                    <?php foreach ($breadcrumbs as $crumb): ?>
                        <li>
                            <?= $this->Html->link($crumb->title, [
                                'plugin' => $crumb->plugin,
                                'controller' => $crumb->controller,
                                'action' => $crumb->action
                            ]) ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </nav>
        <?php endif; ?>
        */ ?>
        <!-- Breadcrumb Navi -------------------------------------- -->
    <main class="main">
        <div class="container">
            <?php
            // Flash messages, aber nicht beim redirect wenn User nicht eingeloggt ist
            $flashMessages = $this->Flash->render();
            if (strpos($flashMessages, 'not authorized') === false) {
                echo $flashMessages;
                
            }
            ?>
            <?= $this->fetch('content') ?>
        </div>
    </main>
    <footer>
    </footer>
        <script>
            function initDelete(id) {
                const wrapper = document.getElementById(`delete-wrapper-${id}`);
                /* ##### Alter block
                 `<p>
                    <span class="text-danger me-2">Möchtest du wirklich löschen?</span><br>
                    <button onclick="confirmDelete('${id}')" 
                            class="btn btn-danger btn-sm">
                        Bestätigen
                    </button>
                    <button onclick="cancelDelete('${id}')" 
                            class="btn btn-secondary btn-sm">
                        Abbrechen
                    </button>
                    </p>
                ` */ 
                wrapper.innerHTML = `
                    <!--<div style="display: inline-block; border: 1px solid #292929; border-radius: 5px; padding: 2px;">-->
                    <div class="button-delete-cancel" onclick="cancelDelete('${id}')">
                    <img src="/img/icons/material_cancel_ffffff.svg" alt="Löschen abbrechen" title="Löschen abbrechen" onclick="cancelDelete('${id}')"> <br>
                    </div>
                    <div class="button-delete-confirm" onclick="confirmDelete('${id}')">
                    <img src="/img/icons/material_delete_ffffff.svg" alt="Löschen bestätigen" title="Löschen bestätigen" onclick="confirmDelete('${id}')"> <br>
                    </div>
                    <!--</div>-->

                    
                `;

            }

            function confirmDelete(id) { 
                document.getElementById('deleteId').value = id;
                document.getElementById('deleteForm').submit();
            }

            function cancelDelete(id) {
                const wrapper = document.getElementById(`delete-wrapper-${id}`);
                wrapper.innerHTML = `
                    <img src="<?= $this->Url->build('img/icons/material_delete_292929.svg') ?>" width="32" height="32" alt="Löschen" title="Löschen" onclick="initDelete('${id}')" class="deleteLink"/>
                `;
            }
            
            // Crop Images
            document.addEventListener('DOMContentLoaded', function() {
                const avatarInput = document.querySelector('#avatar');
                const preview = document.querySelector('#avatar-preview');
                const cropContainer = document.querySelector('#crop-container');
                const cropData = document.querySelector('#avatar-crop');
                
                avatarInput.addEventListener('change', function(e) {
                    if (e.target.files.length) {
                        const reader = new FileReader();
                        reader.onload = function(event) {
                            // Cropper initialisieren
                            const image = document.createElement('img');
                            image.id = 'image-to-crop';
                            image.src = event.target.result;
                            
                            cropContainer.innerHTML = '';
                            cropContainer.appendChild(image);
                            cropContainer.style.display = 'block';
                            
                            const cropper = new Cropper(image, {
                                aspectRatio: 1,
                                viewMode: 1,
                                autoCropArea: 1,
                                responsive: true,
                                crop(event) {
                                    cropData.value = JSON.stringify(event.detail);
                                }
                            });
                        }
                        reader.readAsDataURL(e.target.files[0]);
                    }
                });
            });


        // Breadcrumb Collapse    
            function toggleBreadcrumb(toggleEl) {
                const list = document.getElementById('breadcrumb');
                const collapsedItems = list.querySelectorAll('.breadcrumb-container-item[data-collapsible="true"]');
                const dots = list.querySelector('.breadcrumb-toggle');
                const collapseControl = list.querySelector('.breadcrumb-collapse-control');

                const isExpanded = dots.classList.contains('hidden');

                if (!isExpanded) {
                    console.log('collapsed');
                    // Aufklappen
                    collapsedItems.forEach(el => el.classList.remove('collapsed'));
                    dots.classList.add('hidden');
                    collapseControl.classList.remove('hidden');
                    // dots.style.hidden = 'true';
                    // dots.style.transition = 'hidden 0.5s ease-in-out';
                } else {
                    console.log('expanded');
                    // Zuklappen
                    collapsedItems.forEach(el => el.classList.add('collapsed'));
                    dots.classList.remove('hidden');
                    collapseControl.classList.add('hidden');
                    // dots.style.hidden = 'false';
                }
            }
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
 
</body>
</html>
