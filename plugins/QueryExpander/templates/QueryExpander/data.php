<?php
$report = $this->request->getSession()->read('crt.report');

?>
<div class="query-expander-data content">
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
        <?= $this->Form->create(null, [
            'url' => ['action' => 'result'],
        ]) ?>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Auswahl</th>
                        <th>Name</th>
                        <th>Expression</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($dataItems as $item => $value) : ?>
                    <tr>
                        <td>
                            <div class="form-check">
                                
                            <label class="checkbox-container" style="margin: 6px auto;">
                            <?= $this->Form->checkbox('selected_items[]', [
                                'value' => $item,
                                'type' => 'checkbox',
                                'hiddenField' => false,
                                // 'templates' => [
                                //     'checkboxContainer' => '<label class="checkbox-checkmark">{{input}}<span class="checkmark"></span></label>'
                                // ]
    
                            ]) ?>
                            <span class="checkmark"></span>
                            </label>
                            </div>  
                        </td>
                        <td><?= h($item) ?></td>
                        <td style="font-family: monospace, monospace; font-size: 1.2rem;"><?= wordwrap($value['expression'], 100, '</br>') ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="search-replace">
        <div>
            <!-- <h3></h3> -->
            <fieldset class="form-group" style="border: 1px solid #ccc; padding: 10px; border-radius: 5px;">
                <legend><h3>Data Item Name anpassen</h3></legend>
            <?= $this->Form->control('name_search', ['label' => '', 'placeholder' => 'Zu suchender Text']) ?>
            <?= $this->Form->control('name_replace', ['label' => '', 'placeholder' => 'Ersetzen mit']) ?>
            <p>
                <label class="checkbox-container" style="display: inline-block; margin-right: 20px;">
                <?= $this->Form->checkbox('name_ignore_case') ?>
                <span class="checkmark" style="margin-right: 30px"></span>
                </label>
                <span>
            Groß-und Kleinschreibung ignorieren
            </span>
            </p> 

            <?php // $this->Form->control('name_ignore_case', ['type' => 'radio', 'label' => 'Ignoriere Groß-und Kleinschreibung']) ?>
            </fieldset>
        </div>
        
        <div>
            <fieldset class="form-group" style="border: 1px solid #ccc; padding: 10px; border-radius: 5px;">
                <legend><h3>Expression anpassen</h3></legend>
            <?= $this->Form->control('expr_search', ['label' => '', 'placeholder' => 'Zu suchender Text']) ?>
            <?= $this->Form->control('expr_replace', ['label' => '', 'placeholder' => 'Ersetzen mit']) ?>
            <p>
                <label class="checkbox-container" style="display: inline-block; margin-right: 20px;">
                <?= $this->Form->checkbox('expr_ignore_case') ?>
                <span class="checkmark" style="margin-right: 30px"></span>
                </label>
                <span>
            Groß-und Kleinschreibung ignorieren
            </span>
            </p> 
            </fieldset>

        </div>
        </div>
        <?= $this->Form->button('Nächster Schritt', ['class' => 'button']) ?>
        <?= $this->Form->end() ?>
    </div>
</div>

<?php /*
<div class="query-expander-queries data-items">
    <h1><?= $this->get('title') ?></h1>
    <p>für Query: <code><?= h($selectedQuery['name']) ?></code></p>
    
    <?= $this->Form->create(null, [
        'url' => ['action' => 'result', '?' => ['form' => 'form_data_items']],
    ]) ?>
    
    <table class="table">
        <thead>
            <tr>
                <th>Auswahl</th>
                <th>Name</th>
                <th>Expression</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($dataItems as $item => $value) : ?>
            <tr>
                <td>
                    <div class="form-check">
                    <?= $this->Form->checkbox('selected_items[]', [
                        'value' => $item,
                        'class' => 'form-check-input',
                        'type' => 'checkbox',
                        'hiddenField' => false
                    ]) ?>
                    </div>  
                </td>
                <td><?= h($item) ?></td>
                <td><code><?= h($value['expression']) ?></code></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    
    <div class="mt-4">
        <h4>Data Item Name anpassen:</h4>
        <?= $this->Form->control('name_search', ['label' => 'Text suchen']) ?>
        <?= $this->Form->control('name_replace', ['label' => 'Ersetzen mit']) ?>
    </div>
    
    <div class="mt-4">
        <h4>Expression anpassen:</h4>
        <?= $this->Form->control('expr_search', ['label' => 'Text suchen']) ?>
        <?= $this->Form->control('expr_replace', ['label' => 'Ersetzen mit']) ?>
    </div>
    
    <?= $this->Form->button('Nächster Schritt', ['class' => 'btn btn-primary mt-3']) ?>
    <?= $this->Form->end() ?>

</div>
*/ ?>