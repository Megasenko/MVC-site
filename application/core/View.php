<?php

class View
{
    //public $template_view; // здесь можно указать общий вид по умолчанию.

    /*
    $content_file - виды отображающие контент страниц;
    $template_file - общий для всех страниц шаблон;
    $data - массив, содержащий элементы контента страницы. Обычно заполняется в модели.
    */
    function generate($content_view, $data = null, $templateView = 'templateView.php')
    {
        /*
        if(is_array($data)) {

            // преобразуем элементы массива в переменные
            extract($data);
        }
        */

        /*
        динамически подключаем общий шаблон (вид),
        внутри которого будет встраиваться вид
        для отображения контента конкретной страницы.
        */
        include 'application/views/' . $templateView;
    }


    public function viewTitle()
    {
        $arr = explode('.', $_SERVER['REQUEST_URI']);
        $str = substr($arr[0], 1);

        if ($str) {
            echo 'MVC site - ' . ucfirst($str);
        } else {
            echo 'MVC site';
        }
    }
}
