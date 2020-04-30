<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);?>
<?
$INPUT_ID = trim($arParams["~INPUT_ID"]);
if(strlen($INPUT_ID) <= 0)
	$INPUT_ID = "title-search-input";
$INPUT_ID = CUtil::JSEscape($INPUT_ID);

$CONTAINER_ID = trim($arParams["~CONTAINER_ID"]);
if(strlen($CONTAINER_ID) <= 0)
	$CONTAINER_ID = "title-search";
$CONTAINER_ID = CUtil::JSEscape($CONTAINER_ID);
?>

<div class="siteTitle__live-search live-search js-liveSearch is-top" style="display:none;">
    <div class="form">
        <form action="javascript:void(0);">
            <div id="site-search" class="live-search__input">
                <div class="layout layout--header">
                    <div class="form-element">
                        <input id="site-search-input" type="text" name="q" class="form-control has-clear has-close js-liveSearchInput" placeholder="Поиск по сайту"><span class="error">Сообщение об ошибке</span><span class="clear js-clear"><span class="clear__text">Очистить</span></span><span class="close js-liveSearchClose"></span>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    BX.ready(function(){
        window.title_search = new JCTitleSearch({
            'AJAX_PAGE' : '<?echo CUtil::JSEscape(POST_FORM_ACTION_URI)?>',
            'CONTAINER_ID': '<?echo $CONTAINER_ID?>',
            'INPUT_ID': '<?echo $INPUT_ID?>',
            'MIN_QUERY_LEN': 2
        });
    });
</script>