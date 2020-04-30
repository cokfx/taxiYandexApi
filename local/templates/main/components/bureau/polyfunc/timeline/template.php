<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<?
    $monthNames = [
        1 => 'ЯНВАРЬ',
        2 => 'ФЕВРАЛЬ',
        3 => 'МАРТ',
        4 => 'АПРЕЛЬ',
        5 => 'МАЙ',
        6 => 'ИЮНЬ',
        7 => 'ИЮЛЬ',
        8 => 'АВГУСТ',
        9 => 'СЕНТЯБРЬ',
        10 => 'ОКТЯБРЬ',
        11 => 'НОЯБРЬ',
        12 => 'ДЕКАБРЬ',
    ];
?>
<div class="timeline"><a class="timeline__prev js-timeline__prev" href="javascript:void(0);"></a><a class="timeline__next js-timeline__next" href="javascript:void(0);"></a>
    <div class="timeline__container swiper-container">
        <div class="swiper-wrapper">
            <? foreach($arResult as $year => $monthes): ?>
            <div class="timeline__item js-timeline__item swiper-slide">
                <div class="timeline__box">
                    <div class="timeline__date js-timeline__date"><?=$year?></div>
                    <ul class="timeline__months js-timeline__months" style="display:none;">
                        <? foreach ($monthes as $monthNumber): ?>
                        <li class="timeline__month"><a class="timeline__month-link" href="javascript:void(0);" data-year="<?=$year?>" data-month="<?=$monthNumber?>"><?=$monthNames[$monthNumber]?></a></li>
                        <? endforeach; ?>
                    </ul>
                </div>
            </div>
            <? endforeach; ?>
        </div>
    </div>
    <div class="timeline__mobile-months">
        <ul class="timeline__months js-timeline__mobile-months" style="display:none;">
            <li class="timeline__month"><a class="timeline__month-link" href="javascript:void(0);">ЯНВАРЬ</a></li>
            <li class="timeline__month"><a class="timeline__month-link" href="javascript:void(0);">ФЕВРАЛЬ</a></li>
            <li class="timeline__month"><a class="timeline__month-link" href="javascript:void(0);">МАРТ</a></li>
            <li class="timeline__month"><a class="timeline__month-link" href="javascript:void(0);">АПРЕЛЬ</a></li>
            <li class="timeline__month"><a class="timeline__month-link" href="javascript:void(0);">МАЙ</a></li>
            <li class="timeline__month"><a class="timeline__month-link" href="javascript:void(0);">ИЮНЬ</a></li>
            <li class="timeline__month"><a class="timeline__month-link" href="javascript:void(0);">ИЮЛЬ</a></li>
            <li class="timeline__month"><a class="timeline__month-link" href="javascript:void(0);">АВГУСТ</a></li>
            <li class="timeline__month"><a class="timeline__month-link" href="javascript:void(0);">СЕНТЯБРЬ</a></li>
            <li class="timeline__month"><a class="timeline__month-link" href="javascript:void(0);">ОКТЯБРЬ</a></li>
            <li class="timeline__month"><a class="timeline__month-link" href="javascript:void(0);">НОЯБРЬ</a></li>
            <li class="timeline__month"><a class="timeline__month-link" href="javascript:void(0);">ДЕКАБРЬ</a></li>
        </ul>
    </div>
</div>