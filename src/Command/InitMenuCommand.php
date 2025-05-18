<?php
declare(strict_types=1);

namespace App\Command;

use Cake\Command\Command;
use Cake\Console\Arguments;
use Cake\Console\ConsoleIo;
use Cake\Console\ConsoleOptionParser;

/**
 * InitMenuCommand command.
 */
class InitMenuCommand extends Command
{
    /**
     * The name of this command.
     *
     * @var string
     */
    protected string $name = 'init_menu_command';

    /**
     * Get the default command name.
     *
     * @return string
     */
    public static function defaultName(): string
    {
        return 'init_menu_command';
    }

    /**
     * Get the command description.
     *
     * @return string
     */
    public static function getDescription(): string
    {
        return 'Command description here.';
    }

    /**
     * Hook method for defining this command's option parser.
     *
     * @see https://book.cakephp.org/5/en/console-commands/commands.html#defining-arguments-and-options
     * @param \Cake\Console\ConsoleOptionParser $parser The parser to be defined
     * @return \Cake\Console\ConsoleOptionParser The built parser.
     */
    public function buildOptionParser(ConsoleOptionParser $parser): ConsoleOptionParser
    {
        return parent::buildOptionParser($parser)
            ->setDescription(static::getDescription());
    }

    /**
     * Implement this method with your command's logic.
     *
     * @param \Cake\Console\Arguments $args The command arguments.
     * @param \Cake\Console\ConsoleIo $io The console io
     * @return int|null|void The exit code or null for success
     */
    public function execute(Arguments $args, ConsoleIo $io)
    {
        $menuNodesTable = $this->getTableLocator()->get('MenuNodes');
        $menuNodesTable->deleteAll([]);

        $menuData = [
        [
                'title' => 'Home',
                'controller' => 'Pages',
                'action' => 'display',
                'url' => '/',
                'children' => [
                    // Tools-Bereich
                    [
                        'title' => 'Admin: Tools',
                        'controller' => 'Tools',
                        'action' => 'index',
                        'url'=> 'tools/list',
                        'children' => [
                            [
                                'title' => 'View Tool',
                                'controller' => 'Tools',
                                'action' => 'view',
                                'url' => 'tools/view/*'
                                
                            ],
                            [
                                'title' => 'Add Tool',
                                'controller' => 'Tools',
                                'action' => 'add',
                                'url'=> 'tools/add'
                            ],
                            [
                                'title' => 'Edit Tool',
                                'controller' => 'Tools',
                                'action' => 'edit',
                                'url'=> 'tools/edit/*'
                            ],
                            // [
                            //     'title' => 'Select Report',
                            //     'controller' => 'Tools',
                            //     'action' => 'selectReport',
                            //     'url'=> 'tools/select-report'
                            // ],
                            // [
                            //     'title' => 'Query Expander',
                            //     'plugin' => 'QueryExpander',
                            //     'controller' => 'QueryExpander',
                            //     'action' => 'queries',
                            //     'url'=> 'tools/query-expander/queries',
                            //     'children' => [
                            //         [
                            //             'title' => 'Query Data',
                            //             'plugin' => 'QueryExpander',
                            //             'controller' => 'QueryExpander',
                            //             'action' => 'data',
                            //             'url'=> 'tools/query-expander/data',
                            //             'children' => [
                            //                 [
                            //                     'title' => 'Query Result',
                            //                     'plugin' => 'QueryExpander',
                            //                     'controller' => 'QueryExpander',
                            //                     'action' => 'result',
                            //                     'url'=> 'tools/query-expander/result',
                            //                 ]
                            //             ]
                            //         ]
                            //     ]
                            // ]
                        ]
                    ],

                    [
                        'title' => 'Select Tool',
                        'controller' => 'Tools',
                        'action' => 'selectTool',
                        'url'=> 'tools/',
                        'children' => [
                            [
                                'title' => 'Select Report',
                                'controller' => 'Tools',
                                'action' => 'selectReport',
                                'url'=> 'tools/select-report',
                                'children' => [
                                    // Tool: QueryExpander
                                    [
                                        'title' => 'Query Expander',
                                        'plugin' => 'QueryExpander',
                                        'controller' => 'QueryExpander',
                                        'action' => 'queries',
                                        'url'=> 'tools/query-expander/queries'
                                    ],
                                    [
                                        'title' => 'Query Expander',
                                        'plugin' => 'QueryExpander',
                                        'controller' => 'QueryExpander',
                                        'action' => 'queries',
                                        'url'=> 'tools/query-expander/queries',
                                        'children' => [
                                            [
                                                'title' => 'Data Item Settings',
                                                'plugin' => 'QueryExpander',
                                                'controller' => 'QueryExpander',
                                                'action' => 'data',
                                                'url'=> 'tools/query-expander/data',
                                                'children' => [
                                                    [
                                                        'title' => 'Query Result',
                                                        'plugin' => 'QueryExpander',
                                                        'controller' => 'QueryExpander',
                                                        'action' => 'result',
                                                        'url'=> 'tools/query-expander/result',
                                                    ]
                                                ]
                                            ]
                                        ]
                                    ]
                                    // Next Tool: tba...
                                ]
                            ]
                        ]
                    ],
                    
                    // Users-Bereich
                    [
                        'title' => 'Admin: Users',
                        'controller' => 'Users',
                        'action' => 'index',
                        'url'=> 'users/',
                        'children' => [
                            [
                                'title' => 'View User',
                                'controller' => 'Users',
                                'action' => 'view',
                                'url'=> 'users/view/*'
                            ],
                            [
                                'title' => 'Add User',
                                'controller' => 'Users',
                                'action' => 'add',
                                'url'=> 'users/add'
                            ],
                            [
                                'title' => 'Edit User',
                                'controller' => 'Users',
                                'action' => 'edit',
                                'url'=> 'users/edit/*'
                            ],
                            [
                                'title' => 'User Settings',
                                'controller' => 'Users',
                                'action' => 'settings',
                                'url'=> 'users/settings/*',
                                'children' => [
                                    [
                                        'title' => 'Change Password',
                                        'controller' => 'Users',
                                        'action' => 'changePassword',
                                        'url'=> 'users/change-password/*'
                                    ]
                                ]
                            ]
                        ]
                    ],
                    
                    // Reports-Bereich
                    [
                        'title' => 'My Reports',
                        'controller' => 'Reports',
                        'action' => 'index',
                        'url'=> 'reports/',
                        'children' => [
                            [
                                'title' => 'View Report',
                                'controller' => 'Reports',
                                'action' => 'view',
                                'url'=> 'reports/view/*',
                            ],
                            [
                                'title' => 'Add Report',
                                'controller' => 'Reports',
                                'action' => 'add',
                                'url'=> 'reports/add',
                            ],
                            [
                                'title' => 'Edit Report',
                                'controller' => 'Reports',
                                'action' => 'edit',
                                'url'=> 'reports/edit/*',
                            ]
                        ]

                    ],
                    [
                        'title' => 'Admin: Reports',
                        'controller' => 'Reports',
                        'action' => 'indexAdmin',
                        'url'=> 'reports/index-admin'
                    ]
                ]
            ]
        ];
        $this->saveMenuTree($menuData);
        $io->success("Menü importiert!");
    }

private function saveMenuTree(array $data, ?int $parentId = null): void
{
    $menuNodesTable = $this->getTableLocator()->get('MenuNodes');

    foreach ($data as $item) {
        // URL automatisch generieren falls nicht gesetzt
        if (!isset($item['url'])) {
            $pluginPrefix = !empty($item['plugin']) ? '/' . strtolower($item['plugin']) : '';
            $item['url'] = $pluginPrefix . '/' . strtolower($item['controller']) . '/' . strtolower($item['action']);
        }

        $children = $item['children'] ?? [];
        unset($item['children']);

        $node = $menuNodesTable->newEntity([
            'title' => $item['title'],
            'controller' => $item['controller'] ?? null,
            'action' => $item['action'] ?? null,
            'plugin' => $item['plugin'] ?? null,
            'url' => $item['url'],
            'parent_id' => $parentId // Wird explizit gesetzt
        ]);

        if ($menuNodesTable->save($node)) {
            if (!empty($children)) {
                $this->saveMenuTree($children, $node->id); // parent_id = aktuelle Node-ID
            }
        } else {
            debug($node->getErrors()); // Fehler debuggen
        }
    }
}
}
