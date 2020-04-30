<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<div data-form="SIMPLE_FORM_8" data-ajax="true" <?/*data-success="false"
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
    <input type="hidden" name="form_text_66" value="<?=str_replace('"', "'", $arParams["PROGRAM_NAME"])?>" />
    <input type="hidden" name="form_text_67" value="<? if($arParams["PRICE"] != 'free'): ?><?=$arParams["PRICE"]?> руб.<? else: ?>бесплатно<? endif; ?>" />
    <div class="form__header">
        <h3 class="title title--events">Форма записи</h3>
    </div>
    <div class="form__content">
        <div class="form-group">
            <div class="form-element">
                <input name="form_text_68" class="form-control has-clear" type="text" placeholder="ФИО" required><span class="clear js-clear"><span class="clear__text">Очистить</span></span>
            </div>
        </div>
        <div class="form-group form-inline form-inline--half">
            <div class="form-element">
                <input name="form_text_69" class="form-control has-clear" type="email" placeholder="E-mail" value="" data-email-field><span class="clear js-clear"><span class="clear__text">Очистить</span></span>
            </div>
            <div class="form-element">
                <input name="form_text_70" class="form-control has-clear" type="tel" placeholder="Телефон для связи" value="" data-mask="phone" required><span class="clear js-clear"><span class="clear__text">Очистить</span></span>
            </div>
        </div>
        <div class="form-group">
            <div class="form-element">
                <input name="form_text_71" class="form-control" type="text" placeholder="Место работы" required>
            </div>
        </div>
        <div class="form-group">
            <div class="form-element">
                <input name="form_text_72" class="form-control" type="text" placeholder="Врачебная специальность" required>
            </div>
        </div>
		
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
		
        <div class="form-group">
            <div class="label-group">
                <div class="label-item">
                    <label class="label label--checkbox">
                        <input name="submit-agree" type="checkbox" class="required-checkbox" required><span class="icon icon--checkbox"></span><span class="label__text">Отправляя заявку, я соглашаюсь на <a target="_blank" href="/politika-obrabotki-personalnykh-dannykh-v-oao-meditsina/" class="link">обработку персональных данных</a></span>
                    </label>
                </div>
                <div class="label-item">
                    <label class="label label--checkbox">
                        <input name="submit-agree-2" type="checkbox" class="required-checkbox" required checked><span class="icon icon--checkbox"></span><span class="label__text">Согласие с <a href="javascript:void(0);" class="link">договором офертой</a> подтверждаю</a></span>
                    </label>
                </div>
            </div>
        </div>
    </div>
    <div class="form__footer">
        <div class="form__footer-item cost cost--inline">
            <div class="cost__item cost__text">Стоимость участия: </div>
            <div class="cost__item cost__price"><? if($arParams["PRICE"] != 'free'): ?><?=$arParams["PRICE"]?> ₽<? else: ?>бесплатно<? endif; ?></div>
        </div>
        <div class="form__footer-item button-group"><button type="submit" name="web_form_submit" class="button button--lg" onClick="window.orderSeminar=true">записаться</button></div>
    </div>
    <input type="hidden" name="web_form_apply" value="Y" />
    <?=$arResult["FORM_FOOTER"]?>
</div>
