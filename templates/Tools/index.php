<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Tool> $tools
 */
?>
<!-- <div class="users view content"> -->
<div class="apps-title">
    <?= $this->Html->image('icons/crt_292929.svg', [''=> '','class'=> '', 'style' => 'width: 40px; height: 40px; display: inline-block;']) ?>
    <span><h1 style="display: inline;"><?= h($this->get('title')) ?> </h1></span>
</div>
    <div class="home tools-list">
            <?= $this->AppCards->renderAll('tools', $user->get('role')) ?>
    </div>  
<!-- </div> -->