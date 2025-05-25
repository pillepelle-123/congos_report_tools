<?= $this->Form->create(null, [
    'url' => ['controller' => 'QueryExpander', 'action' => 'data'],
    // 'type' => 'post'
]) ?>
<div class="query-expander-queries content">
    <div class="title">

        <div class="left">
            <h3>
                <?= __($this->get('title')) ?>&nbsp;&nbsp;
                <span style="vertical-align: text-bottom;">

                <?= $this->Html->tag('i', '', [
                    'class' => 'bi bi-question-square help-hover-icon',
                    'alt' => 'Get Help',
                    // 'title' => 'Get Help',
                    'onmouseenter' => 'showHelp(this)',
                    'onmouseleave' => 'showHelp(this)'
                    
                ]); ?>
                    
                <!-- <i class="bi bi-question-square" style="font-size: 16px;">

                </i> -->
                </span>
            </h3>
            <div class="help-hover-text" style="position: absolute; left: 250px; top: 18px; display:none;">Bitte wähle eine Query des Reports aus.</div>
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
    <p>Report: <strong><?= $report->name ?></strong></p>
    <div class="body" >
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th></th>
                        <th>Name</th>
                        <th>Data Items</th>
                    </tr>
                </thead>
                <tbody>
                <?php $i = 0;
                foreach ($queries as $index => $query): ?> 
                    <tr>
                        <td>
                            <div class="input radio-container">
                                <?= $this->Form->radio('selected_query', [$index => $query['name']], 
                                [
                                    'type' => 'radio',
                                    'class' => 'radio-checked',
                                    'id' => 'active',
                                    'autocomplete' => 'off',
                                    'label' => false,
                                    'hiddenField' => false,
                                ]); ?>
                                <?php /* // label wird für Radio nicht benötigt
                                 $this->Form->label('Checkbox Click Area', '', [
                                        'class' => 'radio',
                                        'for' => 'selected_query',
                                    ]); */ ?>
                                <span class="checkmark"></span>
                            </div>
                            <?php /*
                            // ALTE VARIANTE - Funktioniert auch noch 
                            <label class="radio-container">
                                <?= $this->Form->radio('selected_query', [
                                    $index => $query['name'] // Nur der Name wird angezeigt
                                ], ['label' => false, 'hiddenField' => false ]) ?>
                                <span class="checkmark"></span>
                            </label>
                            */ ?>
                        </td>
                        <td>
                            <?= h($query['name']) ?>
                        </td>
                        <td>
                            
                            <?php 
                            // echo $this->Html->image('icons/material_arrow_circle_dropdown_292929.svg', ['alt' => 'Show Data Items', 'title' => 'Show Data Items', 'class' => 'show-data-items', 'style' => 'width: 30px; height: 30px; display: inline-block;', 'onClick' => 'childrenToggleVisibility('.$i.')']);
                            ?>
                            <a <?php
                            echo 'onClick=" childrenToggleVisibility(' . $i .', this)"' ?> class="" style="cursor: pointer;">
                            
                            <img src="/img/icons/eye_fill_292929.svg" alt="Show Data Items" title="Show Data Items" class="show-data-items" style="width: 25px; height: 25px; display: inline-block;">

                            <!-- <i class="bi bi-eye-fill"> -->
                            </a>
            
                                <div <?php echo 'id="div-query-' . $i . '" class="display-data-items-container" style="display:none;"' ?> >
                                <!-- <pre> -->
                                    
                                <fieldset class="display-data-items">
                                    <legend><span>Data Items</span></legend>
                                    <span>
                                    <!-- <pre> -->
                                <?php 
                                //    debug($query->data_items);
                                //    die();
                                $items = [];
                                //    debug ($query['data_items']);
                                if(isset($query['data_items']) ) {
                                    // $all = $query['data_items']->attributes();
                                    foreach ($query['data_items'] as $item) {
                                            $att = $item->attributes();
                                            array_push($items, $att['name']);
                                        //$items .= $att['name'] . ', ';
                                    }
                                } else {
                                    $items = 'No data items found';
                                }
                                //    foreach ($query->data_items as $item) {
                                //        $items .= $item['name'];
                                //    }
                                //    debug($query['data_items']);
                                //    die();
                                //echo wordwrap($items). '';  //substr(h($query['xml']), 0, 80), 50, '<br>'
                                // echo substr(h($items), 0, 200);
                                echo '<span style="font-size: 1.2rem;">';
                                echo h(implode(', ', $items));
                                echo '</span>';
                                    ?>
                                    </span>
                                    <!-- </pre> -->
                                </fieldset>
                                    <!-- </pre> -->
                                </div>
                            
                        </td>
                        <?= $this->Form->hidden("queries.$index.xml", ['value' => $query['xml']]) ?>
                        <?= $this->Form->hidden("queries.$index.name", ['value' => $query['name']]) ?>
                    </tr>
                    <?php 
                    $i++;
                    endforeach;
                    ?>
                </tbody>
            </table>
        </div>
        <?= $this->Form->button('Nächster Schritt', ['class' => 'button']) ?>
        <?= $this->Form->end() ?>
    </div>
</div>
<script>
    // function childrenToggleVisibility(i, selfElement){
    //     let div = document.getElementById(`div-query-${i}`);
    //     let link = this;
    //     console.log('vorher: ' + div.style.display);
    //     if(div.style.display == "none") {
    //             selfElement.innerHTML = '<i class="bi bi-eye-slash-fill"></i>';
    //             div.style.display = "block";
    //             console.log('nachher: ' + div.style.display);
    //         } else {
    //             selfElement.innerHTML = '<i class="bi bi-eye-fill"></i>';
    //             div.style.display = "none";
    //             console.log(div.style.display);
    //         }

    //     // }
    // }

    // function showHelp(element) {
    //     let div = document.getElementsByClassName(`help-hover-text`)[0];
    //     if (div.style.display === "none") {
    //         div.style.display = "inline";
    //     } else {
    //         div.style.display = "none";
    //     }

    //     // viewIconClass = viewIconClass.replace('-fill', '');

    //     // viewIcon.setAttribute('class', viewIconClass.replace('-fill', ''));
    // }

</script>

<script>
    // function childrenToggleVisibility(i, selfElement){
    //     let div = document.getElementById(`div-query-${i}`);
    //     let link = this;
    //     console.log(selfElement);
    //     let children = div.children;
    //     for (let i = 0; i < children.length; i++) {
    //         if(children[i].style.display === "none") {
    //             selfElement.innerHTML = '▼&nbsp;Hide';
    //             children[i].style.display = "block";
    //             console.log(children[i] + ': ' + children[i].style.display);
    //         } else {
    //             selfElement.innerHTML = '▶&nbsp;Show';
    //             children[i].style.display = "none";
    //             console.log(children[i].style.display);
    //         }
    //     }
    //     }
</script>