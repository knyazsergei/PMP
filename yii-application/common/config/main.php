<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '<controller>/<action>' => '<controller>/<action>',
            ]
        ],
        'search' => [
            'class' => 'himiklab\yii2\search\Search',
            'models' => [
                'app\modules\page\models\Page',
            ],
        ],
    ],
     'modules' => [
         'comments' => [
            'class' => 'rmrevin\yii\module\Comments\Module',
            'userIdentityClass' => 'app\models\User',
            'useRbac' => true,
        ],
         'redactor' => 'yii\redactor\RedactorModule',
         'categories' => [
             'class' => 'yiimodules\categories\Module',
         ],
    ]
];
