<?php
// $modifiedXmlContent = $this->getRequest()->getSession()->read('crt.modifiedXmlContent');
// $report = $this->getRequest()->getSession()->read('crt.report');

?>
<div class="query-expander-result content">
    <div class="title">
        <div class="left">
            <h3><?= __($this->get('title')) ?></h3>
        </div>
        <div class="right">
            <div class="display-tool" style="">

                <div><?= $tool->name ?></div>
                <div><?= $this->Html->image($tool->icon, [
                    'alt' => h($tool->name),
                ]) ?>
                </div>
            </div>
        </div>

    </div>
    <p>Report: <strong><?= $report->name ?></strong>&emsp;Query: <strong><?= h($selectedQuery['name']) ?></strong></p>    
    <div class="body" >
        <div>  
            <?= $this->Form->create(null, [
                'url' => ['action' => 'resultDownload'],
                'type' => 'post',
                'id' => 'downloadForm'
            ]) ?>
            <?= $this->Form->button('Download', [
                'class' => 'button',
                'id' => 'downloadBtn'
            ]) ?>
            <?= $this->Form->end() ?>

        </div>
        
        <div class="card mb-4">
            <fieldset class="form-group card-body fieldset-xml">
                <legend><span style="font-weight: normal; margin: 0px 5px; ">Modifiziertes XML</span></legend>
                    <span>
                    <?= h($modifiedXmlContent) ?>
                    </span>
            </fieldset>
        </div>
    </div>
</div>
<script>
document.getElementById('downloadBtn').addEventListener('click', function(e) {
    // Formular absenden
    document.getElementById('downloadForm').submit();
    
    // Alternative: Direkter Download-Link
    // window.location.href = '<?= $this->Url->build(['action' => 'resultDownload']) ?>';
});
</script>

<?php /*
<div class="query-expander result">
    <h1><?= $this->get('title') ?></h1>
    <div>  

        <?= $this->Form->create(null, [
            'url' => ['action' => 'resultDownload'],
            'type' => 'post',
            'id' => 'downloadForm'
        ]) ?>
        <?= $this->Form->button('Download', [
            'class' => 'btn btn-success',
            'id' => 'downloadBtn'
        ]) ?>
        <?= $this->Form->end() ?>

    </div>
    
    <div class="card mb-4">
        <div class="card-header">Modifizierte XML</div>
        <div class="card-body">
            <pre><?= h($modifiedXmlContent) ?></pre>
        </div>
    </div>
    
</div>
<script>
document.getElementById('downloadBtn').addEventListener('click', function(e) {
    // Formular absenden
    document.getElementById('downloadForm').submit();
    
    // Alternative: Direkter Download-Link
    // window.location.href = '<?= $this->Url->build(['action' => 'resultDownload']) ?>';
});
</script>
*/ ?>