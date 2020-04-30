<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 28.10.2018
 * Time: 17:01
 */

use \Bitrix\Main\Page\Asset;
\Bitrix\Main\Loader::includeModule('Cab.tools');
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta name="robots" content="noindex, nofollow"/>
    <title><?php $APPLICATION->ShowTitle(); ?></title>

    <?
    $APPLICATION->ShowHead();
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/bootstrap_reset.css");
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/bootstrap-3.3.2-dist/css/bootstrap.css");
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/bootstrap-3.3.2-dist/css/bootstrap-theme.min.css");
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/owl.carousel.min.css");
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/owl.theme.default.min.css");
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/uikit.oknarostapartners.min.css");
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/jquery-ui.min.css.css");
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/window-aluminium.css.css");
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/main_style.css");
    /*JS*/

    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/jquery-3.3.1.min.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/bootstrap-3.3.2-dist/js/bootstrap.min.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/uikit.min.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/uikit-icons-oknarosta.min.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/jquery.transit.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/owl.carousel.min.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/query.fancybox.pack.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/slick.min.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/aw-script.js");



    // Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/main.js");
    //подрубаем поиск:
    //Asset::getInstance()->addJs('/search/ajax_search.js');
    // Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/index.js");


    //$APPLICATION->ShowCSS();
    //$APPLICATION->ShowHeadScripts();
    ?>
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
    <? // include($_SERVER["DOCUMENT_ROOT"] . "/lib/ClN1.php"); ?>
    <script src="//api-maps.yandex.ru/2.0-stable/?load=package.standard&lang=ru-RU" type="text/javascript"></script>
</head>
<body>
<div id="bx-admin-panel"><? $APPLICATION->ShowPanel() ?></div>
<div id="overlay"></div>
<div id="loader" class="loader hidden"></div>

<div class="main-wrapper">

    <header class="header main-backgrnd">
        <div class="container">
            <div class="col-md-6 header-left">

                <div class="row">
                    <?//= $data["city"]; ?>
                </div>
                <div class="row">
                    <!--<ul class="nav">
                        <li>
                            <a href="/">Главная</a>
                        </li>
                        <li>
                            <a href="/razrabotka">Разработка</a>
                        </li>
                        <li>
                            <a href="/test">Тест</a>
                        </li>
                        <li>
                            <a href="/myproject">/myproject</a>
                        </li>
                    </ul>-->
                    <div class="clearfix"></div>
                </div>
            </div>


            <div class="col-md-6 header-right">

                <img  id="js-searchBlock" onclick="openModal(this);" width="70"
                     src="<?=SITE_TEMPLATE_PATH ?>/img/search-512.png">

                <div class="burger box" id="js-sectionsBlock" onclick="openModal(this);">


                    <div id="btn1" class="btn1 not-active">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>

                </div>
            </div>
            <div style="color: #fff;" id="user-city"></div>

        </div>
    </header>
    <?/* $APPLICATION->IncludeComponent(
        "cokfx:live.search",
        "",
        Array(
            "CACHE_TIME" => "3600",
            "CACHE_TYPE" => "A",
            "IBLOCK_ID" => "23",
            "IBLOCK_TYPE" => "razrabotka",
            "ITEMS_LIMIT" => "10"
        )
    ); */?>
    <div class="sections-block" id="js-sectionsBlockId">
        <div class="container">
            <?/* $APPLICATION->IncludeComponent(
                "bitrix:catalog.section.list",
                "tree",
                Array(
                    "ADD_SECTIONS_CHAIN" => "Y",
                    "CACHE_GROUPS" => "Y",
                    "CACHE_TIME" => "36000000",
                    "CACHE_TYPE" => "A",
                    "COMPONENT_TEMPLATE" => "tree",
                    "COUNT_ELEMENTS" => "Y",
                    "IBLOCK_ID" => "44",
                    "IBLOCK_TYPE" => "development",
                    "SECTION_CODE" => "",
                    "SECTION_FIELDS" => array(0 => "", 1 => "",),
                    "SECTION_ID" => $_REQUEST["SECTION_ID"],
                    "SECTION_URL" => "/razrabotka/list.php?SECTION_ID=#ID#",
                    "SECTION_USER_FIELDS" => array(0 => "", 1 => "",),
                    "SHOW_PARENT_NAME" => "Y",
                    "TOP_DEPTH" => "2",
                    "VIEW_MODE" => "LINE"
                )
            ); */?>
        </div>
    </div>
    <main class="container">
        <div class="row">










