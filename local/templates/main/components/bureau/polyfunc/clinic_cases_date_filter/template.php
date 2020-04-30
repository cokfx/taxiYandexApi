<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<?
    $monthNames = [
        1 => 'Январь',
        2 => 'Февраль',
        3 => 'Март',
        4 => 'Апрель',
        5 => 'Май',
        6 => 'Июнь',
        7 => 'Июль',
        8 => 'Август',
        9 => 'Сентябрь',
        10 => 'Октябрь',
        11 => 'Ноябрь',
        12 => 'Декабрь',
    ];
?>
<div class="clinic__dropbox">
    <select id="clinic-cases-year" class="form-control select-small-custom js-select-dateFilter" data-placeholder="Год">
        <option value="">Год</option>
        <? foreach ($arResult['YEARS'] as $year): ?>
            <option value="<?=$year?>"><?=$year?></option>
        <? endforeach; ?>
    </select>
    <select id="clinic-cases-month" class="form-control select-small-custom js-select-dateFilter" data-placeholder="Месяц">
        <option value="">Месяц</option>
        <? foreach ($monthNames as $monthNumber => $monthName): ?>
            <option value="<?=$monthNumber?>"><?=$monthName?></option>
        <? endforeach; ?>
    </select>
    <div class="clinic__dropboxClear"><span>Сбросить</span></div>
</div>