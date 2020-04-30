<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
use \Bureau\Site\Constant;
use \Bureau\Site\Entities\IBlockEntity;

if(is_numeric($arParams['PROGRAM_ID']) && $arParams['PROGRAM_ID'] > 0) {
    $ibEntityProgramsHeir = IBlockEntity::GetInstanceOfHeirByIblockID(
        Constant::PROGRAMS_FOR_PATIENTS_IBLOCK_ID
    );
    $program = $ibEntityProgramsHeir->GetInstanceByBitrixID($_GET['program']);
    if(!$program->GetData())
        goto showNoFindProgramError;
} else {
    showNoFindProgramError:
    echo '<h3>Программа обслуживания не найдена!</h3>';
    return;
}

$allowedAnswers = $program->GetProperty('ANSWERS');
if(!empty($allowedAnswers)) {
    $ibEntityAnswersHeir = IBlockEntity::GetInstanceOfHeirByIblockID(
        Constant::PATIENTS_PROGRAM_ANSWERS_IBLOCK_ID
    );
    $ageAnswers = $ibEntityAnswersHeir->InstancesArrayByFilter([
        'ID' => $allowedAnswers,
        'SECTION_ID' => Constant::PAT_PRM_ANSWERS_AGE_SECTION_ID,
        'INCLUDE_SUBSECTIONS' => 'Y'
    ], true, ['SORT' => 'ASC']);
    $mkadAnswers = $ibEntityAnswersHeir->InstancesArrayByFilter([
        'ID' => $allowedAnswers,
        'SECTION_ID' => Constant::PAT_PRM_ANSWERS_MKAD_SECTION_ID,
        'INCLUDE_SUBSECTIONS' => 'Y'
    ], true, ['SORT' => 'ASC']);
    $periodAnswers = $ibEntityAnswersHeir->InstancesArrayByFilter([
        'ID' => $allowedAnswers,
        'SECTION_ID' => Constant::PAT_PRM_ANSWERS_PERIOD_SECTION_ID,
        'INCLUDE_SUBSECTIONS' => 'Y'
    ], true, ['SORT' => 'ASC']);
    $prenatalAnswers = $ibEntityAnswersHeir->InstancesArrayByFilter([
        'ID' => $allowedAnswers,
        'SECTION_ID' => Constant::PAT_PRM_ANSWERS_PRENATAL_SECTION_ID,
        'INCLUDE_SUBSECTIONS' => 'Y'
    ], true, ['SORT' => 'ASC']);
}

?>

<div data-form="SIMPLE_FORM_4" data-ajax="true" <?/*data-success="false"
     data-popup-type="success-FORM"*/?>>
    <div class="form-note"></div>
    <div class="form-error"></div>
    <?=$arResult["FORM_HEADER"]?>
    <?
    foreach ($arResult["QUESTIONS"] as $FIELD_SID => $arQuestion) {
        if ($arQuestion['STRUCTURE'][0]['FIELD_TYPE'] == 'hidden') {
            echo $arQuestion["HTML_CODE"];
        }
    }
    ?>
    <input type="hidden" name="form_text_16" value="<?=str_replace('"', "'", $program->GetField('NAME'))?>" />
    <input id="patient-prm-buy-price-val" type="hidden" name="form_text_23" value="<?=number_format($program->GetProperty('PRICE'), 2, ',', ' ')?> руб." />
    <div class="form__header">
        <h3 class="title title--service"><?=$program->GetField('NAME')?></h3>
    </div>
    <div class="form__content">
        <? if(!empty($prenatalAnswers)): ?>
        <div class="form-group">
            <div class="form-element">
                <select name="form_text_73" class="form-control select-custom patient-prm-buy-select" data-placeholder="Дородовое обслуживание" onchange="window.CalcPatientProgramPrice()" required>
                    <option value="" hidden>Дородовое обслуживание</option>
                    <? foreach($prenatalAnswers as $answer): ?>
                        <option value="<?=$answer->GetField('NAME')?>" data-multiplier="<?=$answer->GetProperty('PRICE_MULTIPLIER') ?: 1?>" data-supplement="<?=$answer->GetProperty('PRICE_SUPPLEMENT') ?: '0'?>"><?=$answer->GetField('NAME')?></option>
                    <? endforeach; ?>
                </select>
            </div>
        </div>
        <? endif; ?>
        <div class="form-group">
            <div class="form-element">
                <input class="form-control has-clear" name="form_text_18" type="text" placeholder="ФИО" value="" required><span class="clear js-clear"><span class="clear__text">Очистить</span></span>
            </div>
        </div>
        <div class="form-group">
            <div class="form-element">
                <input class="form-control has-clear" name="form_text_19" type="tel" placeholder="Ваш телефон" minlength="17" data-mask="phone" value="" required><span class="clear js-clear"><span class="clear__text">Очистить</span></span>
            </div>
        </div>
        <div class="form-group">
            <div class="form-element">
                <input class="form-control has-clear" name="form_text_20" type="email" placeholder="Ваш e-mail" value="" data-email-field><span class="clear js-clear"><span class="clear__text">Очистить</span></span>
            </div>
        </div>
        <? if(!empty($ageAnswers)): ?>
        <div class="form-group">
            <div class="form-element">
                <select name="form_text_21" class="form-control select-custom patient-prm-buy-select" data-placeholder="Возраст" onchange="window.CalcPatientProgramPrice()" required>
                    <option value="" hidden>Возраст</option>
                    <? foreach($ageAnswers as $answer): ?>
                        <option value="<?=$answer->GetField('NAME')?>" data-multiplier="<?=$answer->GetProperty('PRICE_MULTIPLIER') ?: 1?>" data-supplement="<?=$answer->GetProperty('PRICE_SUPPLEMENT') ?: '0'?>"<?
                        if($arParams['AGE_FROM'] >= ($answer->GetProperty('AGE_FROM') ?: INF)
                            && $arParams['AGE_TO'] <= ($answer->GetProperty('AGE_TO') ?: 0))
                            echo ' selected';
                        ?>><?=$answer->GetField('NAME')?></option>
                    <? endforeach; ?>
                </select>
            </div>
        </div>
        <? endif; ?>
        <? if(!empty($mkadAnswers)): ?>
        <div class="form-group">
            <div class="form-element">
                <select name="form_text_22" class="form-control select-custom patient-prm-buy-select" data-placeholder="Оказание скорой медицинской помощи на дому с выездом" onchange="window.CalcPatientProgramPrice()" required>
                    <option value="" hidden>Оказание скорой медицинской помощи на дому с выездом</option>
                    <? foreach($mkadAnswers as $answer): ?>
                        <option value="<?=$answer->GetField('NAME')?>" data-multiplier="<?=$answer->GetProperty('PRICE_MULTIPLIER') ?: 1?>" data-supplement="<?=$answer->GetProperty('PRICE_SUPPLEMENT') ?: '0'?>"><?=$answer->GetField('NAME')?></option>
                    <? endforeach; ?>
                </select>
            </div>
        </div>
        <? endif; ?>
        <? if(!empty($periodAnswers)): ?>
        <div class="form-group">
            <div class="label-group">
                <div class="label-item">
                    <div class="title title--xs title--gray">Период обслуживания</div>
                </div>
                <? foreach($periodAnswers as $answer): ?>
                <div class="label-item">
                    <label class="label label--radio">
                        <input type="radio" name="form_text_17" class="patient-prm-buy-radio" value="<?=$answer->GetField('NAME')?>" data-multiplier="<?=$answer->GetProperty('PRICE_MULTIPLIER') ?: 1?>" data-supplement="<?=$answer->GetProperty('PRICE_SUPPLEMENT') ?: '0'?>" onchange="window.CalcPatientProgramPrice()"<?=(++$iterator == 1 ? ' checked' : '')?>><span class="icon icon--radio"></span><span class="label__text"><?=$answer->GetField('NAME')?></span>
                    </label>
                </div>
                <? endforeach; ?>
            </div>
        </div>
        <? endif; ?>
		
		<?if($arResult["isUseCaptcha"] == "Y"):?>
			<div class="form-group">
				<div class="label-group">
					<div class="label-item mb3">
						<div class="title title--xs title--gray"><?=GetMessage("FORM_CAPTCHA_TABLE_TITLE")?></div>
					</div>
					<div class="label-item text-right">
						<div class="label"><input type="hidden" name="captcha_sid" value="<?=htmlspecialcharsbx($arResult["CAPTCHACode"]);?>" /><img src="/bitrix/tools/captcha.php?captcha_sid=<?=htmlspecialcharsbx($arResult["CAPTCHACode"]);?>" width="180" height="40" /></div>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="label-group">
					<div class="label-item mb3">
						<div class="title title--xs title--gray"><?=GetMessage("FORM_CAPTCHA_FIELD_TITLE")?><?=$arResult["REQUIRED_SIGN"];?></div>
					</div>
					<div class="label-item">
						<div class="label"><input type="text" name="captcha_word" value="" class="form-control" required /></div>
					</div>
				</div>
			</div>
		<?endif?>
		
    </div>
    <div class="form__footer">
        <div class="form__footer-item">
            <div class="label-group">
                <div class="label-item">
                    <label class="label label--checkbox">
                        <input name="submit-agree" type="checkbox" class="required-checkbox" required><span class="icon icon--checkbox"></span><span class="label__text">Отправляя заявку, я соглашаюсь<br> на <a target="_blank" href="/politika-obrabotki-personalnykh-dannykh-v-oao-meditsina/" class="link">обработку персональных данных</a></span>
                    </label>
                </div>
                <div class="label-item">
                    <label class="label label--checkbox">
                        <input name="submit-agree-2" type="checkbox" class="required-checkbox" required checked><span class="icon icon--checkbox"></span><span class="label__text">Согласие с <a href="javascript:void(0);" class="link">договором офертой</a> подтверждаю</a></span>
                    </label>
                </div>
            </div>
        </div>
        <div class="form__footer-item">
            <div class="cost cost--inline">
                <div class="cost__item cost__text">Расчетная сумма:</div>
                <div id="patient-prm-buy-price-text" class="cost__item cost__price"><?=number_format($program->GetProperty('PRICE'), 2, ',', ' ')?> ₽</div>
            </div>
            <div class="button-group"><button type="submit" name="web_form_submit" class="button button--accent button--lg" onClick="window.orderServiceProgram=true">отправить</button></div>
        </div>
    </div>
    <input type="hidden" name="web_form_apply" value="Y" />
    <?=$arResult["FORM_FOOTER"]?>
</div>
