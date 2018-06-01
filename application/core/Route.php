<?php

/*
Класс-маршрутизатор для определения запрашиваемой страницы.
> цепляет классы контроллеров и моделей;
> создает экземпляры контролеров страниц и вызывает действия этих контроллеров.
*/

class Route
{
    static function start()
    {
        // контроллер и действие по умолчанию
        $controllerName = 'Main';
        $actionName = 'index';

        $toExplode = explode('?', $_SERVER['REQUEST_URI']);

        $routes = explode('/', $toExplode[0]);
        $params = isset($toExplode[1]) ? $toExplode[1] : null;

        // получаем имя контроллера
        if (!empty($routes[1])) {
            $controllerName = $routes[1];
        }

        // получаем имя экшена
        if (!empty($routes[2])) {
            $actionName = $routes[2];
        }

        // добавляем префиксы
        $modelName = 'Model' . ucfirst($controllerName);

        $controllerName = 'Controller' . ucfirst($controllerName);
        $actionName = $actionName.'Action';

        /*
        echo "Model: $modelName <br>";
        echo "Controller: $controllerName <br>";
        echo "Action: $action_name <br>";
        */

        // подцепляем файл с классом модели (файла модели может и не быть)

//        $model_file = $modelName . '.php';
//        $model_path = "application/models/" . $model_file;
//        if (file_exists($model_path)) {
//            include "application/models/" . $model_file;
//        }

        // подцепляем файл с классом контроллера
//        $controller_file = $controllerName . '.php';
//        $controller_path = "application/controllers/" . $controller_file;

//        if (file_exists($controller_path)) {
//            include "application/controllers/" . $controller_file;
//        } else {
//            /*
//            правильно было бы кинуть здесь исключение,
//            но для упрощения сразу сделаем редирект на страницу 404
//            */
//            Route::ErrorPage404();
//        }


        // создаем контроллер
        $controller = new $controllerName;
        $action = $actionName;

        if (method_exists($controller, $action)) {
            // вызываем действие контроллера
            if (null != $params) {
                $controller->$action($params);
            } else {
                $controller->$action();
            }

        } else {
            // здесь также разумнее было бы кинуть исключение
            Route::ErrorPage404();
        }

    }

   static function ErrorPage404()
    {
        $host = 'http://' . $_SERVER['HTTP_HOST'] . '/';
        header('HTTP/1.1 404 Not Found');
        header("Status: 404 Not Found");
        header('Location:' . $host . '404');
    }

}
