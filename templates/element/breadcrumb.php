<div class="breadcrumb">
            <?php if ($this->Identity->isLoggedIn()): ?>
                <div class="left">
                    <?php
                    if ($this->Identity->isLoggedIn()) {
                        $delimiter = '&nbsp;▶&nbsp;';
                        $lastPageTitle = '';
                        $lastPageLink = [];
                        $backLinkText = '';
                        $info = $this->UserInfo->getInfo($this, $this->request);

                        debug($info);
                        //die();

                        if ($info['template'] !== 'home') {
                            $lastPageTitle = 'Home';
                            $lastPageLink = ['controller' => 'Pages', 'action' => 'home'];
                            $backLinkText .= $this->Html->link($lastPageTitle, url: $lastPageLink);
                        }
                        if ($info['controller'] === 'Users') {
                            if ($info['action'] === 'changePassword') {
                                $lastPageTitle = 'My User Settings';
                                $lastPageLink = ['controller' => 'Users', 'action' => 'settings', $this->Identity->get('id')];
                                $backLinkText .= $delimiter . $this->Html->link($lastPageTitle, url: $lastPageLink);
                            }
                            if ($info['action'] === 'edit' || $info['action'] === 'view') {
                                $lastPageTitle = 'Admin: Users';
                                $lastPageLink = ['controller' => 'Users', 'action' => 'index', $this->Identity->get('id')];
                                $backLinkText .= $delimiter . $this->Html->link($lastPageTitle, url: $lastPageLink);
                            }
                        }
                        if ($info['controller'] === 'Reports') {
                            if ($info['action'] === 'edit' || $info['action'] === 'view') {
                                $lastPageTitle = 'My Reports';
                                $lastPageLink = ['controller' => 'Reports', 'action' => 'index'];
                                $backLinkText .= $delimiter . $this->Html->link($lastPageTitle, url: $lastPageLink);
                            }
                        }

                        if ($info['plugin'] === 'QueryExpander') {
                            $backLinkText .= $delimiter . $this->Html->link('App Hub', ['plugin' => false, 'controller' => 'Reports', 'action' => 'crtApps', '?' => ['report_id' => $report->id]]);
                            if ($info['template'] === 'settings' || $info['template'] === 'result') {
                                $backLinkText .= $delimiter . $this->Html->link('Auswahl Query', [
                                    'action' => 'queries']);
                                    if ($info['template'] === 'result') {
                                        $backLinkText .= $delimiter . $this->Html->link('Data Item Settings', [
                                            'action' => 'settings']);
                                    }
                            } 
                        } 
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
                echo $this->Html->image('icons/material_arrow_circle_back_292929.svg', array('title' => $lastPageTitle, 'url' => $lastPageLink));
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