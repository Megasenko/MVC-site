<?php

// подключаем файлы ядра
session_start();
spl_autoload_register(function ($class) {

    $pathControllers = 'application/controllers/' . $class . '.php';
    $pathCore = 'application/core/' . $class . '.php';
    $pathModels = 'application/models/' . $class . '.php';
    $pathView = 'application/view/' . $class . '.php';

    if (file_exists($pathControllers)) {
        require_once $pathControllers;
    } elseif (file_exists($pathCore)) {
        require_once $pathCore;
    } elseif (file_exists($pathModels)) {
        require_once $pathModels;
    } elseif (file_exists($pathView)) {
        require_once $pathView;
    } else {
        Route::ErrorPage404();
    }
});

require_once __DIR__ . '/core/config.php';

/*
Здесь обычно подключаются дополнительные модули, реализующие различный функционал:
	> аутентификацию
	> кеширование
	> работу с формами
	> абстракции для доступа к данным
	> ORM
	> Unit тестирование
	> Benchmarking
	> Работу с изображениями
	> Backup
	> и др.
*/

Route::start(); // запускаем маршрутизатор
