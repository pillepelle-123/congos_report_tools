<?php
namespace App\View\Helper;

use Cake\View\Helper;
use Cake\View\Helper\HtmlHelper;

class SessionLinkHelper extends Helper

{
     public array $helpers = ['Html', 'Form', 'Flash'];

    // public array $helpers = ['Authentication.Identity']; // Load the helper here

    public function initialize(array $config): void
    {
        parent::initialize($config);
    }
    public function create($title, $url, $sessionData)
    {
        $sessionUrl = [
            'controller' => 'Tools',
            'action' => 'selectReport',
            '?' => $sessionData,
            '_redirect' => $url
        ];
        // $this->request->getSession()->write($sessionData->get('tool'));
        return $this->Html->link($title, ['controller' => 'Tools', 'action' => 'storeTool', '?' => $sessionData]);
    }

    /**
     * Create an image link with session data
     *
     * @param string $title The title of the link
     * @param string $url The URL to redirect to
     * @param array $sessionData The session data to store
     * @param string $image_path The path to the image
     * @return string The HTML for the image link
     */
    public function createImage($image_path, $url, $sessionData)
    {
        $sessionUrl = [
            'controller' => 'Tools',
            'action' => 'selectReport',
            '?' => $sessionData,
            '_redirect' => $url
        ];
        // $this->request->getSession()->write($sessionData->get('tool'));
        return $this->Html->image($image_path, ['controller' => 'Tools', 'action' => 'storeTool', '?' => $sessionData]);
    }
}

// $this->Html->link('Logout', url: ['controller' => 'Users', 'action' => 'logout']); ?>