<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<div class="professions layout--professions js-professions" style="display: none;">
    <div class="professions__header">
        <div class="professions__header-title">Специальность врача</div>
        <div class="professions__header-descr">Выберите специальность и нажмите кнопку</div>
        <button class="button button--accent js-doctors-specialties">применить</button><a class="professions__close js-professionsClose" href="javascript:void(0);">Закрыть</a>
    </div>
    <div class="professions__content js-professions__content">
        <div class="professions__wrap professions__wrap--four">
            <?
                $lettersCnt = count($arResult['SPECIALTIES']);
                foreach ($arResult['SPECIALTIES'] as $letter => $letterSpecialties):
                    ++$letterNum;
            ?>
                <div class="professions__item">
                    <div class="professions__title"><?=$letter?></div>
                    <ul class="professions__list">
                        <? foreach ($letterSpecialties as $specialty): ?>
                        <li class="professions__list-item">
                            <label class="label label--checkbox">
                                <input type="checkbox" class="js-doctors-specialty" data-code="<?=$specialty['CODE']?>"><span class="icon icon--checkbox"></span><span class="label__text"><?=$specialty['NAME']?></span>
                            </label>
                        </li>
                        <? endforeach; ?>
                    </ul>
                </div>
                <? if($letterNum % 4 == 0 && $letterNum <= $lettersCnt): ?>
                    </div>
                    <div class="professions__wrap professions__wrap--four">
                <? endif; ?>
            <? endforeach; ?>
        </div>
    </div>
</div>