<?php
namespace App\View\Helper;

use Cake\View\Helper;
use Cake\View\Helper\HtmlHelper;

/**
 * Summary of RefererParamHelper
 * Creates a string for a referer URL with the Controller and Action
 */
class RefererParamHelper extends Helper {

    public function initialize(array $config): void {
        parent::initialize($config);
    }

    public function create ($controller, $action, $params = []): string {
        $url = [
            'controller' => $controller,
            'action' => $action,
        ];

        return implode('.', $url);

        // if (!empty($params)) {
        //     $url['&'] = $params;
        // }
        // debug($this->Html->url($url));
        // die();
        // return $this->Html->url($url);
    }
}