<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Report $entity
 */

use Demyanovs\PHPHighlight\Highlighter;
use Demyanovs\PHPHighlight\Themes\DefaultTheme;
?>
<div class="actions-container">
    
</div>
<div class="column column">
    <div class="reports view content vertical-table">
        <h3><?= h($entity->name) ?></h3>
                    <fieldset class="form-group card-body fieldset-xml">
                <!-- <legend><span style="font-weight: normal; margin: 0px 5px; ">Modifiziertes XML</span></legend> -->
                    <span>
                    <?php
                        $text = '
                        <pre style="display:none;"  data-lang="xml">' . $entity->xml . ' 
                        </pre>
                        '; // optional für graue Leiste mit Dateinamen: data-file="php-highlight/examples/index.php"

                        $highlighter = new Highlighter($text, DefaultTheme::TITLE);
                        // Configuration
                        $highlighter->showLineNumbers(true);
                        $highlighter->showActionPanel(true);
                        echo $highlighter->parse();
                        ?>
                    </span>
            </fieldset>
        

        <?php /*
        <table>
            
            <tr>
                <th><?= __('Name') ?></th>
                <td><?= h($entity->name) ?></td>
            </tr>
            <?php if ($this->Identity->get('role') === 'admin'): ?>
            <tr>
                <th><?= __('User') ?></th>
                <td><?= $entity->hasValue('user') ? $this->Html->link($entity->user->username, ['controller' => 'Users', 'action' => 'view', $entity->user->id]) : '' ?></td>
            </tr>
            <tr>
                <th><?= __('Id') ?></th>
                <td><?= $this->Number->format($entity->id) ?></td>
            </tr>
            <?php endif; ?>
            <tr>
                <th><?= __('Created') ?></th>
                <td><?= h($entity->created) ?></td>
            </tr>
            <tr>
                <th><?= __('Modified') ?></th>
                <td><?= h($entity->modified) ?></td>
            </tr>
        </table>
        
        <div class="text view-report-xml">
            <strong><?= __('Xml') ?></strong>
            <blockquote class="blockquote_xml">
                <?= $this->Text->autoParagraph(h($entity->xml)); ?>
            </blockquote>
        </div>
        */ ?>
    </div>
</div>
