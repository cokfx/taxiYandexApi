<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<div data-form="SIMPLE_FORM_9" data-ajax="true" <?/*data-success="false"
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
        <h3 class="title">Оставить отзыв о клинике</h3>
        <div class="form__descr">Именно ваши отзывы помогают нам становиться для вас лучшими из лучших.</div>
    </div>
    <div class="form__content">
        <div class="form-group">
            <div class="form-element">
                <input class="form-control has-clear" name="form_text_74" type="text" placeholder="Ваше имя" required><span class="clear js-clear"><span class="clear__text">Очистить</span></span>
            </div>
        </div>
        <div class="form-group">
            <div class="form-element">
                <input class="form-control has-clear" name="form_text_75" type="tel" data-mask="phone" placeholder="Телефон" required><span class="clear js-clear"><span class="clear__text">Очистить</span></span>
            </div>
        </div>
        <div class="form-group">
            <div class="form-element">
                <input class="form-control has-clear" name="form_text_76" type="email" placeholder="E-mail" data-email-field required><span class="clear js-clear"><span class="clear__text">Очистить</span></span>
            </div>
        </div>
        <div class="form-group">
            <textarea class="form-control" name="form_textarea_77" rows="5" placeholder="Ваш отзыв" required></textarea>
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
            <div class="button-group"><button type="submit" name="web_form_submit" class="button button--lg" onClick="window.clinicReviewSending=true">Отправить</button></div>
        </div>
        <div class="form-group">
            <div class="personal-data">Отправляя форму, вы даете свое согласие на обработку ваших<a class="link" target="_blank" href="/politika-obrabotki-personalnykh-dannykh-v-oao-meditsina/">персональных данных</a></div>
        </div>
    </div>
    <input type="hidden" name="web_form_apply" value="Y" />
    <?=$arResult["FORM_FOOTER"]?>
</div>
