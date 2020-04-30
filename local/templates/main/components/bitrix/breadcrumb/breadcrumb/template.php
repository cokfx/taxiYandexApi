<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

/**
 * @global CMain $APPLICATION
 */

global $APPLICATION;

//delayed function must return a string
if(empty($arResult))
	return "";

$strReturn = '';

//we can't use $APPLICATION->SetAdditionalCSS() here because we are inside the buffered function GetNavChain()
$css = $APPLICATION->GetCSSArray();
if(!is_array($css) || !in_array("/bitrix/css/main/font-awesome.css", $css))
{
	//$strReturn .= '<link href="'.CUtil::GetAdditionalFileURL("/bitrix/css/main/font-awesome.css").'" type="text/css" rel="stylesheet" />'."\n";
}

$sectionID = $APPLICATION->GetProperty("section_id");

$strReturn .= <<<'BREADCRUMB_TOP'
    <div class="breadcrumbs">
        <ul class="breadcrumbs__list">
            <li class="breadcrumbs__item" id="bx_breadcrumb_0" itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb" itemref="bx_breadcrumb_1">
                <a class="breadcrumbs__link" href="/" itemprop="url">ОАО «Медицина»</a>
            </li>
BREADCRUMB_TOP;

$itemSize = count($arResult);
for($index = 0; $index < $itemSize; $index++)
{
	$title = htmlspecialcharsex($arResult[$index]["TITLE"]);
    if(strlen($title) > 79)
        $title = substr($title, 0, 79) . '…';
	$nextRef = ($index < $itemSize-2 && $arResult[$index+1]["LINK"] <> ""? ' itemref="bx_breadcrumb_'.($index+1).'"' : '');
	$child = ($index > 0? ' itemprop="child"' : '');
	$arrow = ($index > 0? '<i class="fa fa-angle-right"></i>' : '');

	if($arResult[$index]["LINK"] <> "" && $index != $itemSize-1)
	{
		$strReturn .= '
			<li class="breadcrumbs__item'.($sectionID && ++$iterator==1 ? ' breadcrumbs__item--submenu js-trigger-submenu' : '').'"'.($sectionID && $iterator==1 ? ' data-submenu-id="header-nav-submenu-'.$sectionID.'"' : '').' id="bx_breadcrumb_'.$index.'" itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"'.$child.$nextRef.'>
				'.$arrow.'
				<a class="breadcrumbs__link" href="'.$arResult[$index]["LINK"].'" itemprop="url">'.
					/*'<span itemprop="title">'.*/ $title /*.'</span>'*/ .
				'</a>
			</li>';
	}
	else
	{
		$strReturn .= '<li class="breadcrumbs__item"><a class="breadcrumbs__link" href="javascript:void(0);">' . $title . '</a></li>';
	}
}

$strReturn .= <<<'BREADCRUMB_BOTTOM'
        </ul>
    </div>
BREADCRUMB_BOTTOM;

return $strReturn;
