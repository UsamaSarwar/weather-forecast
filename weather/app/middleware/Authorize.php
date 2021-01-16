<?php

namespace Fir\Middleware;

/**
 * Class Authorize takes care of site routing based on user status
 */
class Authorize {

    /**
     * @var array   The list of routes to be blocked from being accessed by Users
     *              Array Map: Key(User Role) => Array(Routes Maps) => (Array(Routes), Array(Redirect))
     */
    protected $except = [
        'guest' => [
            'admin' => [['admin/dashboard*', 'admin/general*', 'admin/weather*', 'admin/themes*', 'admin/languages*', 'admin/info_pages*', 'admin/ads*', 'admin/password*'], ['admin/login']]
        ],
        'admin' => [
            'admin' => [['admin', 'admin/login*'], ['admin/dashboard']]
        ]
    ];

    public function __construct() {
        // Select the route maps based on the user role
        if(isset($_SESSION['isAdmin'])) {
            $user = 'admin';
        } else {
            $user = 'guest';
        }

        foreach($this->except[$user] as $routes) {
            foreach($routes[0] as $route) {
                // If the route has match anything rule (*)
                if(substr($route, -1) == '*') {
                    // If the current path matches a route exception
                    if(isset($_GET['url']) && stripos($_GET['url'], str_replace('*', '', $route)) === 0) {
                        redirect($routes[1][0]);
                    }
                }
                // If the current path matches a route exception
                elseif(isset($_GET['url']) && in_array($_GET['url'], $routes[0])) {
                    redirect($routes[1][0]);
                }
            }
        }
    }
}