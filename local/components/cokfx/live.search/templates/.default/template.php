<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

?>
<!--установить кнопку в шапке сайта-->
<!--<img id="js-searchBlock" onclick="openModal(this);" width="70" src="/local/templates/konstruktor/img/search-512.png">
-->
<div data-path="<?=$componentPath;?>"  class="search-block" id="js-searchBlockId">
    <div class="container">
        <h3>Живой поиск</h3>
        <form action="">

            <input data-iblock="<?=$arParams['IBLOCK_ID']?>"  type="search" class="form-control" maxlength="50" size="15" value="" name="q" id="q"
                   autocomplete="off">

            <button class="reset btn btn-primary mt-15 mb15" id="reset_live_search" value="reset" type="reset">Очистить</button>
            <div id="search_result">
                <div class="live-search">
                </div>
            </div>
        </form>
    </div>
</div>

