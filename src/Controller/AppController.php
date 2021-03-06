<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link      http://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\Routing\Router;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link http://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');
        $this->loadComponent('Auth', [
            'authenticate' => [
                'Form' => [
                    'fields' => [
                        'username' => 'email',
                        'password' => 'password'
                    ]
                ]
            ],
            'authorize' => ['Controller'],
            'loginAction' => [
                'controller' => 'Users',
                'action' => 'login'
            ],
            'loginRedirect' => [
                'controller' => 'Users',
                'action' => 'index'
            ],
            'logoutRedirect' => [
                'controller' => 'Users',
                'action' => 'login'
            ] 
        ]);
    

        
        // Allow the display action so our pages controller
        // continues to work.
        // $this->Auth->allow(['display']);
        
        
        $this->loadComponent('AkkaFacebook.Graph', [
        'app_id' => '1021548931219941',
        'app_secret' => '98b82c08f2d64cfcaac74a2a295da49a',
        'app_scope' => 'email', // https://developers.facebook.com/docs/facebook-login/permissions/v2.3
        'redirect_url' => Router::url(['controller' => 'Users', 'action' => 'login'], TRUE), //ie. Router::url(['controller' => 'Users', 'action' => 'login'], TRUE),
        'post_login_redirect' => Router::url(['controller' => 'Users', 'action' => 'index'], TRUE), //ie. Router::url(['controller' => 'Users', 'action' => 'account'], TRUE)
        'user_columns' => ['first_name' => 'fname', 'last_name' => 'lname', 'username' => 'username', 'password' => 'password'] //not required
        ]);
        
        $this->set('authUser', $this->Auth->user());
    }
    
    public function isAuthorized($user)
    {
        // Admin can access every action
        if (isset($user['role']) && $user['role'] === 'admin') {
            return true;
        }

        // Default deny
        return false;
    }

    /**
     * Before render callback.
     *
     * @param \Cake\Event\Event $event The beforeRender event.
     * @return void
     */
    public function beforeRender(Event $event)
    {
        if (!array_key_exists('_serialize', $this->viewVars) &&
            in_array($this->response->type(), ['application/json', 'application/xml'])
        ) {
            $this->set('_serialize', true);
        }
    }
    
}
