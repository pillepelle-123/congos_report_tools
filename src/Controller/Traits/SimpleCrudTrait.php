<?php
namespace App\Controller\Traits;

use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\Http\Exception\NotFoundException;
use CakeDC\Users\Controller\Traits;
use CakeDC\Users\Controller\UsersController as BaseUsersController;
use CakeDC\Users\Controller\Traits\SimpleCrudTrait as BaseSimpleCrudTrait;
/**
 * Impersonate Trait
 */
trait SimpleCrudTrait
{
    use BaseSimpleCrudTrait;

    public function index()
    {
        $table = $this->fetchTable();
        $tableAlias = $table->getAlias();
        $this->set($tableAlias, $this->paginate($table));
        $this->set('tableAlias', $tableAlias);
        $this->viewBuilder()->setOption('serialize', [$tableAlias, 'tableAlias']);
    }

    public function view($id = null)
    {
        // PSt: Hack -> Zeige Reports des Users an:
        $reports = $this->fetchTable('Reports')->find()
        ->where(['Reports.user_id' => $id])
        ->contain(['Users']);

        $table = $this->fetchTable();
        $tableAlias = $table->getAlias();
        $entity = $table->get($id, contain: []);
        $this->set($tableAlias, $entity);
        $this->set('tableAlias', $tableAlias);
        $this->set('reports', $reports);
        $this->viewBuilder()->setOption('serialize', [$tableAlias, 'tableAlias']);
    }
}


