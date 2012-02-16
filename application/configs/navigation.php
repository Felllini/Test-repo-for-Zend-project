<?php

return array(
    array
    (
        'label' => 'Home',
        'id' => 'home',
        'module' => 'default',
        'controller' => 'index',
        'action' => 'index',
        'route' => 'default',
        'pages' => array
        (
            array
            (
                'label' => 'Home',
                'tag' => 'topMenu',
                'route' => 'default',
                'module' => 'default',
                'controller' => 'index',
                'action' => 'index',
                'resource'      => 'index',
                'privilege'     => 'home',

            ),
            array
            (
                'label' => 'News',
                'tag' => 'topMenu',
                'route' => 'default',
                'module' => 'default',
                'controller' => 'news',
                'action' => 'index',
                'resource'      => 'news',
                'privilege'     => 'news',
//                'pages' => array (
//                    array (
//                        'label' => _('Configure Training Plan'),
//                        'controller' => 'train',
//                        'action' => 'shedule',
//                        'resource'      => 'train',
//                        'privilege'     => 'shedule'
//                    ),
//                    array (
//                        'label' => _('Contact Coach/Support'),
//                        'controller' => 'train',
//                        'action' => 'support',
//                        'resource'      => 'train',
//                        'privilege'     => 'support'
//                    ),
            ),
            array (
                'label' => 'Log In/Register',
                'tag' => 'topLinks',
                'route' => 'default',
                'module' => 'default',
                'controller' => 'users',
                'action' => 'login',
                'resource'      => 'users',
                'privilege'     => 'user'
            ),
            array (
                'label' => 'Log Out',
                'tag' => 'topLinks',
                'route' => 'default',
                'module' => 'default',
                'controller' => 'users',
                'action' => 'logout',
                'resource'      => 'users',
                'privilege'     => 'users'
            ),
            array (
                'label' => 'My Account',
                'tag' => 'topLinks',
                'route' => 'default',
                'module' => 'default',
                'controller' => 'account',
                'action' => 'index',
                'resource'      => 'account',
                'privilege'     => 'account'
            ),
            array (
                'label' => 'Friends',
                'tag' => 'topLinks',
                'route' => 'default',
                'module' => 'default',
                'controller' => 'friends',
                'action' => 'people',
                'resource'      => 'friends',
            ),
            array
            (
                'label' => 'Messages',
                'tag' => 'topLinks',
                'route' => 'default',
                'module' => 'default',
                'controller' => 'message',
                'action' => 'index',
                'resource'      => 'message',
                'privilege'     => 'message',

            )

        )
    )
);
