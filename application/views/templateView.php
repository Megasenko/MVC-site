<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <meta name="description" content=""/>
    <meta name="keywords" content=""/>
    <title><?= $this->viewTitle() ?></title>
    <link href="http://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css"/>
    <link href="http://fonts.googleapis.com/css?family=Kreon" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" type="text/css" href="/css/style.css"/>
    <!-- Bootstrap core CSS-->
    <link href="../../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom fonts for this template-->
    <link href="../../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- Custom styles for this template-->
    <link href="../../css/sb-admin.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript">
        // return a random integer between 0 and number
        function random(number) {

            return Math.floor(Math.random() * (number + 1));
        };

        // show random quote
        $(document).ready(function () {

            var quotes = $('.quote');
            quotes.hide();

            var qlen = quotes.length; //document.write( random(qlen-1) );
            $('.quote:eq(' + random(qlen - 1) + ')').show(); //tag:eq(1)
        });
    </script>
</head>
<body>
<div id="wrapper">
    <div id="header">
        <div id="logo">
            <a href="/">mvc site</a>
        </div>
        <div id="menu">
            <ul>
                <li class="first active"><a href="/">Главная</a></li>
                <?php if (isset ($_SESSION['role']) && $_SESSION['role']==1){
                    echo ' <li><a href="/adminPanel">Admin Panel</a></li>';
                }?>

                <?php if (isset ($_SESSION['access']) && $_SESSION['access']==true){
                    echo '<li><a href="/login/logout">Logout</a></li>';
                } else {
                    echo ' <li><a href="/login">Login</a></li>';
                }
                ?>

                <li class="last"><a href="/blog">Блог</a></li>
            </ul>
            <br class="clearfix"/>
        </div>
    </div>
    <div id="page">
        <div id="sidebar">
            <div class="side-box">
                <h3>Случайная цитата</h3>
                <p align="justify" class="quote">
                    «Сайт, как живой организм, изменяется и развивается.
                    Нельзя сразу написать идеальный вариант и на этом откланяться - это утопия»
                </p>
                <p align="justify" class="quote"><!-- &copy; Vitaly Swipe -->
                    «Все должно быть очень просто, как текстовый файл и при этом функционально
                    и тогда пользователи от нас уйдут»
                </p>
                <p align="justify" class="quote">
                    «Критика - это когда критик объясняет автору, как сделал бы он, если бы умел»
                </p>
                <p align="justify" class="quote"><!-- &copy; Vitaly Swipe -->
                    «Сумасшедшим становиться тот, кто попытался разобраться в этом сумасшедшем мире»
                </p>
                <p align="justify" class="quote">
                    «Опытный разработчик знает, какой выбор ведет к поставленной цели, в то время как
                    новичок каждый раз делает шаг в неизвестность»
                </p>
            </div>
            <div class="side-box">
                <h3>Основное меню</h3>
                <ul class="list">
                    <li class="first "><a href="/">Главная</a></li>
<!--                    <li><a href="/services">Услуги</a></li>-->
<!--                    <li><a href="/portfolio">Портфолио</a></li>-->
<!--                    <li class="last"><a href="/contacts">Контакты</a></li>-->
                    <?php
                    if (isset($_SESSION['name'])) {
                        echo '<li class="last"><a href="/logout">Logout</a></li>';
                        echo '<li>Вы вошли как: <a href="/admin">' . $_SESSION['name'] . '</a></li>';
                    } else {
                        echo '<li class="last"><a href="/login">Login</a></li>';
                    }
                    ?>
                </ul>
            </div>
        </div>
        <div id="content">
            <div class="box">
                <?php include 'application/views/' . $content_view; ?>
                <!--
                <h2>Welcome to Accumen</h2>
                <img class="alignleft" src="images/pic01.jpg" width="200" height="180" alt="" />
                <p>
                        This is <strong>Accumen</strong>, a free, fully standards-compliant CSS template by <a href="http://www.freecsstemplates.org/">Free CSS Templates</a>. The images used in this template are from <a href="http://fotogrph.com/">Fotogrph</a>. This free template is released under a <a href="http://creativecommons.org/licenses/by/3.0/">Creative Commons Attributions 3.0</a> license, so you are pretty much free to do whatever you want with it (even use it commercially) provided you keep the footer credits intact. Aside from that, have fun with it :)
                </p>
                -->
            </div>
            <br class="clearfix"/>
        </div>
        <br class="clearfix"/>
    </div>
    <div id="page-bottom">
        <div id="page-bottom-sidebar">
            <h3>Наши контакты</h3>
            <ul class="list">
                <li class="first">viber: </li>
                <li>skype: </li>
                <li class="last">email: </li>
            </ul>
        </div>
        <div id="page-bottom-content">
            <h3>О Компании</h3>
            <p>
                Вот дом.
                Который построил Джек.

                А это пшеница.
                Которая в тёмном чулане хранится
                В доме,
                Который построил Джек.

                А это весёлая птица-синица,
                Которая ловко ворует пшеницу,
                Которая в тёмном чулане хранится
                В доме,
                Который построил Джек.

                Вот кот,
                Который пугает и ловит синицу,
                Которая ловко ворует пшеницу,
                Которая в тёмном чулане хранится
                В доме,
                Который построил Джек.
            </p>
        </div>
        <br class="clearfix"/>
    </div>
</div>
<div id="footer">
    <a href="/">mvc site</a> &copy; 2018</a>
</div>
</body>
</html>