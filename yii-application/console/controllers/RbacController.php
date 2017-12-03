<?php

namespace console\controllers;

use Yii;
use yii\console\Controller;
use rmrevin\yii\module\Comments\Permission;
use rmrevin\yii\module\Comments\rbac\ItsMyComment;
/**
 * Инициализатор RBAC выполняется в консоли php yii rbac/init
 */
class RbacController extends Controller {

    public function actionInit() {
        $auth = Yii::$app->authManager;
        
        $auth->removeAll(); //На всякий случай удаляем старые данные из БД...
        
        // Создадим роли админа и редактора
        $admin = $auth->createRole('admin');
        $editor = $auth->createRole('editor');
        $viewer = $auth->createRole('viewer');
        
        // запишем их в БД
        $auth->add($admin);
        $auth->add($editor);
        $auth->add($viewer);
        
        // Создаем разрешения. Например, просмотр админки viewAdminPage и редактирование новости updateNews
        $viewAdminPage = $auth->createPermission('viewAdminPage');
        $viewAdminPage->description = 'View admin page';
        
        $updatePost = $auth->createPermission('updatePost');
        $updatePost->description = 'Update post';
        
        // Запишем эти разрешения в БД
        $auth->add($viewAdminPage);
        $auth->add($updatePost);
        
        // Комментарии 
        $ItsMyCommentRule = new ItsMyComment();
        $auth->add($ItsMyCommentRule);

        $createComment = $auth->createPermission(Permission::CREATE);
        $createComment->description = 'Can create own comments';
        $auth->add($createComment);

        $auth->add(new \yii\rbac\Permission([
            'name' => Permission::UPDATE,
            'description' => 'Can update all comments',
        ]));
        $auth->add(new \yii\rbac\Permission([
            'name' => Permission::UPDATE_OWN,
            'ruleName' => $ItsMyCommentRule->name,
            'description' => 'Can update own comments',
        ]));
        $auth->add(new \yii\rbac\Permission([
            'name' => Permission::DELETE,
            'description' => 'Can delete all comments',
        ]));
        $auth->add(new \yii\rbac\Permission([
            'name' => Permission::DELETE_OWN,
            'ruleName' => $ItsMyCommentRule->name,
            'description' => 'Can delete own comments',
        ]));
        // Теперь добавим наследования. Для роли editor мы добавим разрешение updateNews,
        // а для админа добавим наследование от роли editor и еще добавим собственное разрешение viewAdminPage
        
        // Роли «Редактор новостей» присваиваем разрешение «Редактирование новости»
        $auth->addChild($editor,$updatePost);

        // админ наследует роль редактора новостей. Он же админ, должен уметь всё! :D
        $auth->addChild($admin, $editor);
        
        // Еще админ имеет собственное разрешение - «Просмотр админки»
        $auth->addChild($admin, $viewAdminPage);

        //Ещё может добавлять комментарии
        $auth->addChild($admin, $createComment);

        // Назначаем роль admin пользователю с ID 1
        $auth->assign($admin, 1); 
        
        // Назначаем роль editor пользователю с ID 2
        //$auth->assign($editor, 2);


    }
}