<?php if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true)die();?>

<? if(empty($arResult['ITEMS'])): ?>
<? return; endif; ?>

<h3 class="title title--sm title--events">Ближайшие семинары</h3>
<? foreach ($arResult['ITEMS'] as $key => $item): ?>
    <?
    $buyLink = '/spetsialistam/forma-zapisi-na-seminar/';
    $buyLink .= '?price=' . (empty($item['PROPERTIES']['FREE']['VALUE']) ? $item['PROPERTIES']['COST']['VALUE'] : 'free');
    $buyLink .= '&program=' . $item['ID'];
    ?>
    <div class="card card--event">
        <div class="card__wrap">
            <div class="card__item">
                <div class="card__title title"><?=$item['~NAME']?></div>
                <? if(!empty($item['PROPERTIES']['PROGRAM_FILE']['VALUE'])): ?>
                    <a class="card__file link link--icon file" href="<?=\CFile::GetPath($item['PROPERTIES']['PROGRAM_FILE']['VALUE'])?>" target="_blank"><span class="icon icon--file-pdf file__img"></span><span class="link__text link__text--icon-pdf file__name">Скачать программу семинара</span></a>
                <? endif; ?>
            </div>
            <div class="card__item">
                <div class="card__date"><span class="card__date-self"><?= mb_strtolower(FormatDateFromDB($item['PROPERTIES']['DATE_TIME']['VALUE'], 'j F Y')) ?></span><? if(!empty($item['PROPERTIES']['FREE']['VALUE'])): ?><span class="card__date-free">бесплатно</span><? else: ?><span class="card__date-free"><?=$item['PROPERTIES']['COST']['VALUE']?> &#8381;</span><? endif; ?>
                </div><a class="button button--lg" href="<?=$buyLink?>">записаться<? /*if(empty($item['PROPERTIES']['FREE']['VALUE'])): ?> и оплатить<? endif;*/ ?></a><a class="card__add-calendar link" href="http://www.google.com/calendar/event?
action=TEMPLATE
&text=<?=urlencode($item['~NAME'])?>
&dates=<?=FormatDateFromDB($item['PROPERTIES']['DATE_TIME']['VALUE'], 'YYYYMMDD') ?>/<?=date('Ymd', AddToTimeStamp(array("DD" => 1), MakeTimeStamp($item['PROPERTIES']['DATE_TIME']['VALUE']))) ?>
&details=<?=urlencode($item['~PREVIEW_TEXT'])?>
<?/*&location=Moscow*/?>
<?/*&ctz=[timezone]*/?>
&trp=false
&sprop=website:<?=$_SERVER['SERVER_NAME']?>
&sprop=name:Name" target="_blank" rel="nofollow">Добавить в календарь</a>
            </div>
        </div>
    </div>
<? endforeach; ?>