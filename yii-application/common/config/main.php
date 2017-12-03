<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ]
    ],
     'modules' => [
         'comments' => [
            'class' => 'rmrevin\yii\module\Comments\Module',
            'userIdentityClass' => 'app\models\User',
            'useRbac' => true
        ]
    ]
];
