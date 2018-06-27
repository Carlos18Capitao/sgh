<?php

return [
    'role_structure' => [
        'admin' => [
            'admin' => 'c,r,u,d',
            'estoques' => 'c,r,u,d',
            'empenhos' => 'c,r,u,d',
//            'profile' => 'r,u'
        ],
//        'administrator' => [
//            'users' => 'c,r,u,d',
//            'profile' => 'r,u'
//        ],
//        'user' => [
//            'profile' => 'r,u'
//        ],
        'estoque' => [
            'estoques' => 'c,r'
        ],
        'empenhos' => [
            'empenhos' => 'c,r'
        ],
    ],
//    'permission_structure' => [
//        'cru_user' => [
//            'profile' => 'c,r,u'
//        ],
//    ],
    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete'
    ]
];
