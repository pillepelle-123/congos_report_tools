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
    <?php foreach ($tools as $tool): ?>
        <div class="tool-card">
            <?= $this->HomeCards->renderToolCard($tool->toArray()) ?>
        </div>
    <?php endforeach; ?>
</div>  

<?php /*

<div class="home tools-list">
        <?= $this->HomeCards->renderAll('tools', $user->get('role')) ?>
</div>  
<!-- </div> -->
 <div>
 <?= $this->Html->image('icons/crt_292929.svg', ['controller' => 'Tools', 'action' => 'storeTool', '?' => ['tool' => 'QueryExpander'], 'style' => 'width: 40px; height: 40px; display: inline-block;']) ?>
  <?php 
//   echo $this->SessionLink->createImage(
//     'icons/crt_292929.svg' ,
//     ['controller' => 'Tools', 'action' => 'storeTool'],
//     ['tool' => 'QueryExpander']    ) 
    ?>
<!-- $info = $this->UserInfo->getInfo($this, $this->request); -->


 </div>
 */ ?>