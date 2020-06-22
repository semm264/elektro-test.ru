<?php
/*
Краткие пояснения:
 - Этот файл относиться ко 2му заданию
 - Сначало добавил композер и хотел сделать подход mvc(раpбить логику и представление),
    спросил у "Егоров Алексей", что от меня вообще хотят(какую реализацию), ответили, что в тз все есть.
    Исходя из этого понял, что вам нужна простынка тут... Хотя это не есть хорошо.
- пагинацию не стал реализовывать, т.к. не уверен подойдет ли вам мой код ниже и мои коментарии
- база данных находиться в корне
*/

//можно положить сюда и сделать require_once или подключить через композер используя команду USE и подключить autoloader
//'php_interface/lib/SProduction/DataBase/DataBase.php';
class DataBase {
    private static $db = null;
    private $mysqli;

    //можно эти константы ниже вынести например сюда php_interface/config.php
    const DB_HOST = 'localhost';
    const DB_USER = 'root';
    const DB_PASSWORD = '';
    const DB_NAME = 'elektro-test_bd';

    public static function getDB() {
        if (self::$db == null) self::$db = new DataBase();
        return self::$db;
    }

    private function __construct() {
        $this->mysqli = new mysqli(self::DB_HOST, self::DB_USER, self::DB_PASSWORD, self::DB_NAME);
        $this->mysqli->query("SET NAMES 'utf8'");

        if ($this->mysqli->connect_errno) {
            printf("Соединение не удалось: %s\n", $this->mysqli->connect_error);
            exit();
        }
    }

    public function select($query) {
        $result = $this->mysqli->query($query);
        if (!$result) return false;
        else return $this->resultToArray($result);
    }

    public function resultToArray($result) {
        $array = [];
        while (($row = $result->fetch_assoc()) != false) {
            $array[] = $row;
        }
        $result->free();
        return $array;
    }

    public function __destruct() {
        if ($this->mysqli) $this->mysqli->close();
    }
}
//!'php_interface/lib/SProduction/DataBase/DataBase.php';

//это тоже можно вынести отдельно как логику
$db = DataBase::getDB();
$articles = $db->select("SELECT * FROM `articles`");
//!

header("Content-Type: text/html;charset=utf-8");
?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Электро Престиж</title>

    <meta name="keywords" content="Электро Престиж"/>
    <meta name="description" content="Электро Престиж"/>

    <link rel="stylesheet" type="text/css" media="screen" href="./css/reset.css"/>
    <link rel="stylesheet" type="text/css" media="screen" href="./css/style.css"/>
    <link rel="shortcut icon" href="./favicon.png" type="image/png"/>
</head>
<body>
<header>
    <nav class="top-menu container">
        <input id="hamburger-top-menu" type="checkbox"/>
        <label class="hamburger-top-menu__button" for="hamburger-top-menu">
            <span class="hamburger-top-menu__line"></span>
        </label>
        <div class="hamburger-top-menu__overlay"></div>

        <ul class="top-menu__items flex">
            <li class="top-menu__item"><a class="top-menu__link" href="#">О компании</a></li>
            <li class="top-menu__item"><a class="top-menu__link" href="#">Доставка </a></li>
            <li class="top-menu__item"><a class="top-menu__link" href="#">Оплата</a></li>
            <li class="top-menu__item"><a class="top-menu__link" href="#">Сервис</a></li>
            <li class="top-menu__item"><a class="top-menu__link" href="#">Возврат</a></li>
            <li class="top-menu__item"><a class="top-menu__link" href="#" class="active">Статьи</a></li>
            <li class="top-menu__item"><a class="top-menu__link" href="#">Контакты</a></li>
        </ul>
    </nav>

    <div class="line"></div>

    <section class="top-block container flex">
        <div class="top-block__left flex">
            <div class="top-block__logo"><a href="./"><img src="./images/logo.png" alt=""/></a></div>
            <div class="top-block__search">
                <form method="POST" action="#search" class="top-block__form-search flex" name="search">
                    <span class="top-block__search-img"></span>
                    <input type="text" class="top-block__search-text" name="" placeholder="Поиск по товарам" value=""/>
                    <input type="submit" class="top-block__search-submit" value="Отправить"/>
                </form>
            </div>
        </div>
        <div class="top-block__right flex">
            <div class="top-block__kontakts">
                <div class="top-block__phone">8 (800) 707-99-24</div>
                <div class="top-block__schedule">9.00 - 20.00 ежедневно</div>
            </div>

            <div class="top-block__panel flex">
                <a href="#" class="top-block__panel-item flex">
                    <span class="top-block__panel-ico"><img src="./images/rating.png" alt=""/></span>
                    <span class="top-block__panel-value">0</span>
                </a>
                <a href="#" class="top-block__panel-item flex active">
                    <span class="top-block__panel-ico"><img src="./images/heart1.png" alt=""/></span>
                    <span class="top-block__panel-value">6</span>
                </a>
                <a href="#" class="top-block__panel-item flex active">
                    <span class="top-block__panel-ico"><img src="./images/basket1.png" alt=""/></span>
                    <span class="top-block__panel-value">17</span>
                </a>
            </div>
        </div>
    </section>
</header>

<div class="line"></div>

<nav class="main-menu container">
    <ul class="main-menu__items flex">
        <li class="main-menu__item main-menu__item__home">
            <a class="main-menu__link" href="#">Продукция<br/>
                <img src="./images/menu-img.png" alt=""></a>
        </li>
        <li class="main-menu__item"><a class="main-menu__link" href="#">Стабилизаторы 220В</a></li>
        <li class="main-menu__item"><a class="main-menu__link" href="#">Стабилизаторы 380В</a></li>
        <li class="main-menu__item"><a class="main-menu__link" href="#">Генераторы 220В</a></li>
        <li class="main-menu__item"><a class="main-menu__link" href="#">Генераторы 380В</a></li>
        <li class="main-menu__item"><a class="main-menu__link" href="#">ИБП и батареи</a></li>
        <li class="main-menu__item"><a class="main-menu__link" href="#">Прочая техника</a></li>
        <li class="main-menu__item"><a class="main-menu__link" href="#">Услуги</a></li>
        <li class="main-menu__item active"><a class="main-menu__link" href="#" class="active">Акции</a></li>
    </ul>
</nav>

<div class="line"></div>

<section class="breadcrumb container">
    <a class="breadcrumb__link" href="./">Главная</a>
    <span class="breadcrumb__separator">→</span>
    <a class="breadcrumb__link" href="./article">Статьи</a>
</section>

<div class="line"></div>

<section class="content container">
    <h1>Полезная информация</h1>
</section>

<section class="article-block container">
    <div class="pagenation">
        <ul class="pagenation__items flex">
            <li class="pagenation__item active"><a class="pagenation__item-link" href="#">1</a></li>
            <li class="pagenation__item"><a class="pagenation__item-link" href="#">2</a></li>
            <li class="pagenation__item"><a class="pagenation__item-link" href="#">3</a></li>
            <li class="pagenation__item"><a class="pagenation__item-link" href="#">4</a></li>
            <li class="pagenation__item"><a class="pagenation__item-link" href="#">...</a></li>
            <li class="pagenation__item"><a class="pagenation__item-link" href="#">10</a></li>
        </ul>
    </div>

    <div class="article-block__items flex">
        <? foreach ($articles as $article): ?>
            <article class="article-block__item flex">
                <div class="article-block__item-img-wrap">
                    <img src=".<?= $article['article_preview'] ?>" alt=""/>
                </div>
                <div class="article-block__item-body flex">
                    <a href="#" class="article-block__item-name"><?= $article['article_title'] ?></a>
                    <div class="article-block__item-context">
                        <?= $article['article_context'] ?>
                    </div>
                </div>
            </article>
        <? endforeach; ?>
    </div>

    <div class="pagenation">
        <ul class="pagenation__items flex">
            <li class="pagenation__item active"><a class="pagenation__item-link" href="#">1</a></li>
            <li class="pagenation__item"><a class="pagenation__item-link" href="#">2</a></li>
            <li class="pagenation__item"><a class="pagenation__item-link" href="#">3</a></li>
            <li class="pagenation__item"><a class="pagenation__item-link" href="#">4</a></li>
            <li class="pagenation__item"><a class="pagenation__item-link" href="#">...</a></li>
            <li class="pagenation__item"><a class="pagenation__item-link" href="#">10</a></li>
        </ul>
    </div>
</section>

<footer class="footer">
    <div class="container footer__items flex">
        <div class="footer__kontakt footer__item">
            <p>121471, г.Москва ул. Рябиновая 55 стр. 28</p>
            <p>prestizh06@mail.ru</p>
            <p class="bold">8 (800) 707-99-24</p>
            <p><a class="footer__href-active" href="./kontakty">контакты</a></p>
        </div>
        <div class="footer__schedule footer__item">
            <p>Режим работы:</p>
            <p>Пн-чт с 8.00 до 19.00</p>
            <p>Пт с 8.00 до 17.00</p>
            <p>Сб с 10.00 до 15.00</p>
            <p>Вс (по предварительной договоренности).</p>
        </div>
        <div class="footer__menu-block footer__item">
            <nav class="footer-menu">
                <ul class="footer-menu__items flex">
                    <li class="footer-menu__item"><a class="footer-menu__item-link" href="#">О компании</a></li>
                    <li class="footer-menu__item"><a class="footer-menu__item-link" href="#">Оплата</a></li>
                    <li class="footer-menu__item"><a class="footer-menu__item-link" href="#">Акции</a></li>
                    <li class="footer-menu__item"><a class="footer-menu__item-link" href="#">Сервис</a></li>
                    <li class="footer-menu__item"><a class="footer-menu__item-link" href="#">Доставка</a></li>
                    <li class="footer-menu__item active"><a class="footer-menu__item-link" href="#">Возврат</a></li>
                </ul>
            </nav>
            <p>&nbsp;</p>
            <p><a class="footer-menu__item-link" href="#">Политика обработки персональных данных</a></p>
        </div>
        <div class="footer__author footer__item">
            <p><img src="./images/footer-img.png" alt="Разработка и продвижение сайта"/></p>
            <p><a href="https://rbru.ru/" target="_blank" title="Разработка и продвижение сайта">Разработка и
                    продвижение сайта</a></p>
        </div>
    </div>
</footer>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<? /* так же можно вынести отдельно ./js/hamburger-menu.js*/ ?>
<script type="text/javascript">
    $(document).ready(function () {
        $(".hamburger-top-menu__button").bind('click', function () {
            $('body').toggleClass("hamburger-top-menu__body-active");
        });
        $(".hamburger-top-menu__overlay").bind('click', function () {
            $('.hamburger-top-menu__button').trigger('click');
        });
    })
</script>
<? /* ! ./js/hamburger-menu.js*/ ?>
</body>
</html>