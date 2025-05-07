<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Tool $tool
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Tool'), ['action' => 'edit', $tool->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Tool'), ['action' => 'delete', $tool->id], ['confirm' => __('Are you sure you want to delete # {0}?', $tool->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Tools'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Tool'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="tools view content">
            <h3><?= h($tool->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($tool->id) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>