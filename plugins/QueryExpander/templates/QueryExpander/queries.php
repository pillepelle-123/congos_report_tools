<div class="query-expander">
    <?= $this->Form->create(null, [
        'url' => ['controller' => 'QueryExpander', 'action' => 'data'],
        // 'type' => 'post'
    ]) ?>
    <!-- <fieldset> -->
    <div class="users queries content">
    <h3><?= __($this->get('title')) ?></h3>
        <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th >Auswahl</th>
                    <th >Query Name</th>
                    <th >XML Preview</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($queries as $index => $query): ?> 
                <tr>
                    <td>
                <?= $this->Form->radio('selected_query', [
                    $index => $query['name'] // Nur der Name wird angezeigt
                ], [
                    'class' => 'form-check-input',
                    'label' => false,
                    'hiddenField' => false,
                    'required' => true
                ]) ?>
                </td>
                <td>
                    <?= h($query['name']) ?>
                </td>
                <td>
                    <blockquote class="blockquote_xml">
                       <?= wordwrap(substr(h($query['xml']), 0, 280), 50, '<br>') . ''; ?>
                    </blockquote>
                </td>
                <?= $this->Form->hidden("queries.$index.xml", ['value' => $query['xml']]) ?>
                <?= $this->Form->hidden("queries.$index.name", ['value' => $query['name']]) ?>
                </tr>
        <?php endforeach; ?>
        </tbody>
        </table>
    </div>
<!-- </fieldset> -->
    
    <?= $this->Form->button('Nächster Schritt', ['class' => 'btn btn-primary']) ?>
    <?= $this->Form->end() ?>
</div>
</div>
