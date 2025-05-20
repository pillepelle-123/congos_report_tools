<div class="breadcrumb-container">
            <?php if ($this->Identity->isLoggedIn()): ?>
                <div class="left">
                    <?php
                    if ($this->Identity->isLoggedIn()) {
                        $delimiter = '&nbsp;/&nbsp;';
                        $lastPageTitle = '';
                        $lastPageLink = [];
                        $backLinkText = '';
                        // debug($this);
                        // debug($this->plugin);
                        // die();
                        $info = $this->UserInfo->getInfo($this, $this->request);

                        //debug($info);
                        //die();

                        if ($info['template'] !== 'home') {
                            $lastPageTitle = 'Home';
                            $lastPageLink = ['plugin' => false, 'controller' => 'Pages', 'action' => 'home'];
                            $backLinkText .= $this->Html->link($lastPageTitle, url: $lastPageLink);
                        }
                        if ($info['controller'] === 'Users') {
                            if ($info['action'] === 'changePassword') {
                                $lastPageTitle = 'My User Settings';
                                $lastPageLink = ['controller' => 'Users', 'action' => 'settings', $this->Identity->get('id')];
                                $backLinkText .= $delimiter . $this->Html->link($lastPageTitle, url: $lastPageLink);
                            }
                            if ($info['action'] === 'edit' || $info['action'] === 'view' || $info['action'] === 'add') {
                                $lastPageTitle = 'Admin: Users';
                                $lastPageLink = ['controller' => 'Users', 'action' => 'index'];
                                $backLinkText .= $delimiter . $this->Html->link($lastPageTitle, url: $lastPageLink);
                            }
                        }
                        if ($info['controller'] === 'Reports') {
                            if ($info['action'] === 'edit' || $info['action'] === 'view' || $info['action'] === 'add') {
                                if($this->request->getSession()->read('clickpath')[1]['url'] === '/reports/list-admin') {
                                    $lastPageTitle = 'Admin: Reports';
                                    $lastPageLink = ['controller' => 'Reports', 'action' => 'indexAdmin'];
                                } else {
                                    $lastPageTitle = 'My Reports';
                                    $lastPageLink = ['controller' => 'Reports', 'action' => 'index'];
                                }
                                // $lastPageTitle = 'My Reports';
                                // $lastPageLink = ['controller' => 'Reports', 'action' => 'index'];
                                $backLinkText .= $delimiter . $this->Html->link($lastPageTitle, url: $lastPageLink);
                            }
                        }
                        if ($info['controller'] === 'Tools' || isset($info['plugin'])) {     
                            if ($info['action'] === 'selectReport' || $info['action'] === 'view' || isset($info['plugin']) ) {
                                $lastPageTitle = 'Tools';
                                $lastPageLink = ['plugin' => false, 'controller' => 'Tools', 'action' => 'selectTool'];
                                $backLinkText .= $delimiter . $this->Html->link($lastPageTitle, url: $lastPageLink);

                                if ($info['action'] === 'processSelection' || isset($info['plugin'])) {
                                    $lastPageTitle = 'Select Report';
                                    $lastPageLink = ['plugin' => false, 'controller' => 'Tools', 'action' => 'selectReport'];
                                    $sessionData = ['tool' => 'QueryExpander'];

// $this->SessionLink->create(
//     'QueryExpander',                  // Titel des Links
//     ['controller' => 'Tools', 'action' => 'storeTool'],  // Ziel-URL
//     ['tool' => 'QueryExpander']


                                    $backLinkText .= $delimiter . $this->Html->link($lastPageTitle, url: $lastPageLink);
                                }

                                if ($info['plugin'] === 'QueryExpander') {
                                    if ($info['action'] === 'data' || $info['action'] === 'result') {
                                        $lastPageTitle = 'Query Expander';
                                        $lastPageLink = ['plugin' => 'QueryExpander', 'controller' => 'QueryExpander', 'action' => 'queries'];
                                        $backLinkText .= $delimiter . $this->Html->link($lastPageTitle, url: $lastPageLink);

                                        if ($info['action'] === 'result') {
                                            $lastPageTitle = 'Data Item Settings';
                                            $lastPageLink = ['plugin' => 'QueryExpander', 'controller' => 'QueryExpander', 'action' => 'data'];
                                            $backLinkText .= $delimiter . $this->Html->link($lastPageTitle, url: $lastPageLink);
                                        }
                                    }
                                    //     $lastPageTitle = 'Query Expander';
                                    //     $lastPageLink = ['plugin' => 'QueryExpander', 'controller' => 'QueryExpander', 'action' => 'queries'];
                                    //     $backLinkText .= $delimiter . $this->Html->link($lastPageTitle, url: $lastPageLink);
                                    
                                    // $lastPageTitle = 'Query Expander';
                                    // $lastPageLink = ['plugin' => 'QueryExpander', 'controller' => 'QueryExpander', 'action' => 'queries'];
                                    // $backLinkText .= $delimiter . $this->Html->link($lastPageTitle, url: $lastPageLink);
                                }

                            }
                            }



                        // if ($info['plugin'] === 'QueryExpander') {
                        //     $lastPageTitle = 'Tools';
                        //     $lastPageLink = ['plugin''controller' => 'Reports', 'action' => 'indexAdmin'];


                        //     if ($info['action'] === 'edit' || $info['action'] === 'view' || $info['action'] === 'add') {
                        //         if($this->request->getSession()->read('clickpath')[1]['url'] === '/reports/list-admin') {
                        //             $lastPageTitle = 'Admin: Reports';
                        //             $lastPageLink = ['controller' => 'Reports', 'action' => 'indexAdmin'];
                        //         } else {
                        //             $lastPageTitle = 'My Reports';
                        //             $lastPageLink = ['controller' => 'Reports', 'action' => 'index'];
                        //         }
                        //         // $lastPageTitle = 'My Reports';
                        //         // $lastPageLink = ['controller' => 'Reports', 'action' => 'index'];
                        //         $backLinkText .= $delimiter . $this->Html->link($lastPageTitle, url: $lastPageLink);
                        //     }
                        // }
                        // echo '<div style="z-index: 1000; position: relative;">';
                        // debug($info);
                        // echo '</div>';

                        // if ($info['plugin'] === 'QueryExpander') {
                        //     $backLinkText .= $delimiter . $this->Html->link('Tools', ['plugin' => false, 'controller' => 'Tools', 'action' => 'index']);
                        //     if ($info['template'] === 'data' || $info['template'] === 'result') {
                        //         $backLinkText .= $delimiter . $this->Html->link('Query Expander', ['plugin' => 'QueryExpander', 'controller' => 'QueryExpander', 'action' => 'queries']);
                        //             if ($info['template'] === 'result') {
                        //                 $backLinkText .= $delimiter . $this->Html->link('Data Item Settings', ['plugin' => 'QueryExpander', 'controller' => 'QueryExpander', 'action' => 'data']);
                        //             }
                        //     } 
                        // } 
                        if ($info['template'] !== 'home') {
                            $backLinkText .= $delimiter;
                        }
                        $backLinkText .= $this->get('title');

                        echo $backLinkText; 
                    }
                    
                    
                    ?>
                </div>
                <div class="right">      
                <?php
                if ($info['template'] !== 'home') {
                echo $this->Html->image('icons/material_arrow_circle_back_292929.svg', array('title' => $lastPageTitle, 'url' => $lastPageLink, isset($sessionData) ? $sessionData : ''));
                } ?>
                <!-- REPORT -->
                 <?php /*
                    <?php if (!empty($report)): ?>
                        <?php echo h($report->report_name) . '&nbsp;';
                        echo $this->Html->image('icons/material_view.svg', array('title' => 'Report', 'height' => '16', 'width' => '16'));
                        ?>
                    <?php endif; ?>
                    */ ?>

                </div>
            <?php endif; ?>
            </div> 
    </div>