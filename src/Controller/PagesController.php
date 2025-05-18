<?php
declare(strict_types=1);

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Core\Configure;
use Cake\Http\Exception\ForbiddenException;
use Cake\Http\Exception\NotFoundException;
use Cake\Http\Response;
use Cake\View\Exception\MissingTemplateException;
use App\Model\Table\MenuNodesTable;

/**
 * Static content controller
 *
 * This controller will render views from templates/Pages/
 *
 * @link https://book.cakephp.org/5/en/controllers/pages-controller.html
 */
class PagesController extends AppController
{
    protected $Reports;
    protected $user;

    public function initialize(): void
    {
        parent::initialize();
        //$this->Reports = $this->fetchTable('Users');

        $this->user = $this->fetchTable('Users')->find()
            ->where(['id' => $this->identity->get('id')])
            ->contain(['Reports'])
            ->first();

            // $reports = $this->Reports->find()
            // ->where(['user_id' => $this->identity->get('id')])
            // ->orderBy(['modified' => 'DESC']);
    }
    /**
     * Displays a view
     *
     * @param string ...$path Path segments.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Http\Exception\ForbiddenException When a directory traversal attempt.
     * @throws \Cake\View\Exception\MissingTemplateException When the view file could not
     *   be found and in debug mode.
     * @throws \Cake\Http\Exception\NotFoundException When the view file could not
     *   be found and not in debug mode.
     * @throws \Cake\View\Exception\MissingTemplateException In debug mode.
     */
    public function display(string ...$path): ?Response

    {


        $reports = $this->user->get('reports');
            //->orderBy(['modified' => 'DESC']);
        // $reports = $this->Reports->find()
        //     ->where(['user_id' => $this->identity->get('id')])
        //     ->orderBy(['modified' => 'DESC']);
        //     //->all();
        ;
        // Inhalte an Templates übergeben
        //$this->set(compact('user', 'reports')); /alte Variante, klappt aber nicht direkt mit $this->user
        //$this->set(['user' => $this->user, 'reports' => $reports]);

        if (!$path) {
            return $this->redirect('/');
        }
        if (in_array('..', $path, true) || in_array('.', $path, true)) {
            throw new ForbiddenException();
        }
        $page = $subpage = null;

        if (!empty($path[0])) {
            $page = $path[0];
        }
        if (!empty($path[1])) {
            $subpage = $path[1];
        }
        $this->set(compact('page', 'subpage', 'reports'));
        $this->set(['title' => ucfirst($page), 'user' => $this->user]);

        try {
            return $this->render(implode('/', $path));
        } catch (MissingTemplateException $exception) {
            if (Configure::read('debug')) {
                throw $exception;
            }
            throw new NotFoundException();
        }
    }



}
