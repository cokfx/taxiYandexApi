<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<select name="specialty" class="form-control select-custom <?=$arParams['EXT_CLASSES']?>" data-placeholder="Укажите специальность врача">
    <option value="" hidden>Укажите специальность врача</option>
    <? foreach ($arResult['SPECIALTIES'] as $specialty): ?>
    <option value="<?=$specialty['CODE']?>"><?=$specialty['NAME']?></option>
    <? endforeach; ?>
</select>