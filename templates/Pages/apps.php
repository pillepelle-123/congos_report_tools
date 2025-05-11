<!-- <div class="users view content"> -->
<div class="apps-title">
    <?= $this->Html->image('icons/crt_292929.svg', [''=> '','class'=> '', 'style' => 'width: 40px; height: 40px; display: inline-block;']) ?>
    <span><h1 style="display: inline;"><?= h('Apps') ?> </h1></span>
</div>
    <div class="home app-list">
            <?= $this->HomeCards->renderAll($this->getTemplate(), $user->get('role')) ?>
    </div>  
<!-- </div> -->