<?php

use App\Controllers\UserController;
use App\Models\User;
use App\Database\Database;

$db = new Database('db');

$userModel = new User($db);
$userController = new UserController($userModel);

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

switch ($uri) {
    case '/users':
        $userController->index();
        break;
    case '/users/filter':
        $userController->filter();
        break;
    case '/user/create':
        $userController->create();
        break;
    case (preg_match('/\/user\/edit\/\d+/', $uri) ? true : false):
        $id = explode('/', $uri)[3];
        $userController->edit($id);
        break;
    case '/user/store':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userController->store($_POST);
        }
        break;
    case (preg_match('/\/user\/delete\/\d+/', $uri) ? true : false):
        $id = explode('/', $uri)[3];
        $userController->delete($id);
        break;
    default:
        http_response_code(404);
        echo 'Page not found';
        break;
}
