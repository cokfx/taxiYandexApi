<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<div data-form="SIMPLE_FORM_<?=$arParams["MESSAGE_FOR"] == "MED_DIRECTOR" ? 6 : 5?>" data-ajax="true" <?/*data-success="false"
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
    <div class="form__header">
        <h3 class="title">Красный телефон</h3>
        <div class="form__descr">Подобно «Красному телефону» на рецепции, сообщения из этой формы попадают к <?=$arParams["MESSAGE_FOR"] == "MED_DIRECTOR" ? 'Директору медицинской службы, <strong>Тюлькиной Екатерине Евгеньевне.</strong>' : 'Президенту клиники «Медицина», <strong>Ройтбергу Григорию Ефимовичу.</strong>'?><br />Все сообщения рассматриваются в обязательном порядке.</div>
    </div>
    <div class="form__content">
        <div class="form-group">
            <div class="form-element">
                <input class="form-control has-clear" name="form_text_<?=$arParams["MESSAGE_FOR"] == "MED_DIRECTOR" ? 29 : 24?>" type="text" placeholder="Ваше имя" required><span class="clear js-clear"><span class="clear__text">Очистить</span></span>
            </div>
        </div>
        <div class="form-group">
            <div class="form-element">
                <input class="form-control has-clear" name="form_text_<?=$arParams["MESSAGE_FOR"] == "MED_DIRECTOR" ? 30 : 25?>" type="tel" placeholder="Телефон" minlength="17" data-mask="phone" required><span class="clear js-clear"><span class="clear__text">Очистить</span></span>
            </div>
        </div>
        <div class="form-group">
            <div class="form-element">
                <input class="form-control has-clear" name="form_text_<?=$arParams["MESSAGE_FOR"] == "MED_DIRECTOR" ? 31 : 26?>" type="email" placeholder="E-mail" required><span class="clear js-clear"><span class="clear__text">Очистить</span></span>
            </div>
        </div>
        <div class="form-group">
            <textarea class="form-control" name="form_textarea_<?=$arParams["MESSAGE_FOR"] == "MED_DIRECTOR" ? 32 : 27?>" rows="5" placeholder="Ваше сообщение" required></textarea>
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
    </div>
    <div class="form__footer">
        <div class="form-group">
            <div class="button-group"><button type="submit" name="web_form_submit" class="button button--lg" onClick="window.redPhoneSending<?=$arParams["MESSAGE_FOR"] == "MED_DIRECTOR" ? 2 : ''?>=true">Отправить</button></div>
        </div>
        <div class="form-group">
            <div class="personal-data">Отправляя форму, вы даете свое согласие на обработку ваших <a class="link" target="_blank" href="/politika-obrabotki-personalnykh-dannykh-v-oao-meditsina/">персональных данных</a></div>
        </div>
    </div>
    <input type="hidden" name="web_form_apply" value="Y" />
    <?=$arResult["FORM_FOOTER"]?>
</div>
