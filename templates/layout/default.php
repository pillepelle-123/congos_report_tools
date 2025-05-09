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

    <?= $this->Html->css(['normalize.min', 'milligram.min', 'fonts', 'cake']) ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>

    <link href="/fontawesome/css/fontawesome.css" rel="stylesheet" />
    <link href="/fontawesome/css/solid.css" rel="stylesheet" />
    <link href="/fontawesome/css/regular.css" rel="stylesheet" />
    <link href="/fontawesome/css/brands.css" rel="stylesheet" />

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
                    <ul id="user_menu">
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
        <!-- Breadcrumb Navi eingebunden, s. element\breadcrumb.php -->
        <?= $this->element('breadcrumb'/*, ['user' => $user]*/) ?>
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
        </script>
        
</body>
</html>
