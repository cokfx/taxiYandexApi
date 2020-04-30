<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<select name="doctorID" class="form-control select-custom <?=$arParams['EXT_CLASSES']?>" data-placeholder="Выберите ФИО врача из списка">
    <option value="" hidden>Выберите ФИО врача из списка</option>
    <? foreach ($arResult['DOCTORS'] as $doctor): ?>
    <option value="<?=$doctor['ID']?>"><?=$doctor['NAME']?></option>
    <? endforeach; ?>
</select>