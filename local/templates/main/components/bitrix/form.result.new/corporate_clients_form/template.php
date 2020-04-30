<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<div data-form="SIMPLE_FORM_1" data-ajax="true" <?/*data-success="false"
     data-popup-type="success-FORM"*/?> class="js-form" style="display:none;">
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
    <div class="layout layout--form">
        <div class="form__header">
            <h3 class="title">Для расчета стоимости услуг заполните форму ниже</h3>
        </div>
        <div class="form__content">
            <div class="form-group">
                <div class="form-element">
                    <input class="form-control has-clear" name="form_text_1" type="text" required placeholder="Название организации"><span class="clear js-clear"><span class="clear__text">Очистить</span></span>
                </div>
            </div>
            <div class="form-group form-inline form-inline--half">
                <div class="form-element">
                    <input class="form-control has-clear" name="form_text_2" type="tel" required placeholder="Телефон организации" minlength="17" data-mask="phone"><span class="clear js-clear"><span class="clear__text">Очистить</span></span>
                </div>
                <div class="form-element">
                    <input class="form-control has-clear" name="form_text_3" type="email" required placeholder="Контактный e-mail"><span class="clear js-clear"><span class="clear__text">Очистить</span></span>
                </div>
            </div>
            <div class="form-group">
                <div class="form-element">
                    <input class="form-control has-clear" name="form_text_4" type="text" required placeholder="Ваше имя"><span class="clear js-clear"><span class="clear__text">Очистить</span></span>
                </div>
            </div>
            <div class="form-group">
                <div class="form-element">
                    <input class="form-control has-clear" name="form_text_5" type="text" required placeholder="Ваша должность"><span class="clear js-clear"><span class="clear__text">Очистить</span></span>
                </div>
            </div>
            <div class="form-group">
                <div class="form-element">
                    <select name="form_text_6" required class="form-control select-custom js-selectEmployees" data-placeholder="Количество сотрудников">
                        <option value="" hidden>Количество сотрудников</option>
                        <option value="до 5 человек">до 5 человек</option>
                        <option value="от 5 до 10 человек">от 5 до 10 человек</option>
                        <option value="более 10 человек">более 10 человек</option>
                    </select>
                </div>
            </div>
            <div class="form-group form-group--separator form-inline form-inline--half">
                <div class="label-group">
                    <div class="label-item">
                        <div class="title title--xs title--gray">Предусмотрена диспансеризация <br>в программе обслуживания?</div>
                    </div>
                    <div class="label-item">
                        <label class="label label--radio">
                            <input name="form_text_7" type="radio" value="Да" checked><span class="icon icon--radio"></span><span class="label__text">Да</span>
                        </label>
                    </div>
                    <div class="label-item">
                        <label class="label label--radio">
                            <input name="form_text_7" type="radio" value="Нет" checked><span class="icon icon--radio"></span><span class="label__text">Нет</span>
                        </label>
                    </div>
                    <div class="label-item">
                        <label class="label label--radio">
                            <input name="form_text_7" type="radio" value="Затрудняюсь ответить" checked><span class="icon icon--radio"></span><span class="label__text">Затрудняюсь ответить</span>
                        </label>
                    </div>
                </div>
                <div class="label-group">
                    <div class="label-item">
                        <div class="title title--xs title--gray">Предусмотрено медицинское <br>обслуживание для членов семьи сотрудников?</div>
                    </div>
                    <div class="label-item">
                        <label class="label label--radio">
                            <input name="form_text_8" type="radio" value="Да" checked><span class="icon icon--radio"></span><span class="label__text">Да</span>
                        </label>
                    </div>
                    <div class="label-item">
                        <label class="label label--radio">
                            <input name="form_text_8" type="radio" value="Нет" checked><span class="icon icon--radio"></span><span class="label__text">Нет</span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="form-group form-group--separator">
                <textarea class="form-control" name="form_textarea_9" rows="13" placeholder="Ваш комментарий"></textarea>
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
                            <input type="checkbox" name="submit-agree" class="required-checkbox" required><span class="icon icon--checkbox"></span><span class="label__text">Соглашаюсь на обработку моих персональных данных, с <a target="_blank" href="/politika-obrabotki-personalnykh-dannykh-v-oao-meditsina/" class="link">условиями обработки персональных данных</a> ознакомлен(а).</span>
                        </label>
                    </div>
                    <div class="label-item">
                        <label class="label label--checkbox">
                            <input type="checkbox" name="form_checkbox_SIMPLE_QUESTION_653[]" value="10" checked><span class="icon icon--checkbox"></span><span class="label__text">Соглашаюсь на получение информационных и рекламных сообщений. С <a href="/usloviya-predostavleniya-informatsionnykh-i-reklamnykh-soobshcheniy/" class="link">условиями предоставления информационных и рекламных сообщений</a> ознакомлен(а).</span>
                        </label>
                    </div>
                    <?
                    /*if($arResult["isUseCaptcha"] == "Y")
                    {
                        ?>
                        <table>
                            <tr>
                                <th colspan="2"><b><?=GetMessage("FORM_CAPTCHA_TABLE_TITLE")?></b></th>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td><input type="hidden" name="captcha_sid" value="<?=htmlspecialcharsbx($arResult["CAPTCHACode"]);?>" /><images src="/bitrix/tools/captcha.php?captcha_sid=<?=htmlspecialcharsbx($arResult["CAPTCHACode"]);?>" width="180" height="40" /></td>
                            </tr>
                            <tr>
                                <td><?=GetMessage("FORM_CAPTCHA_FIELD_TITLE")?><?=$arResult["REQUIRED_SIGN"];?></td>
                                <td><input type="text" name="captcha_word" size="30" maxlength="50" value="" class="inputtext" /></td>
                            </tr>
                        </table>
                        <?
                    }*/ // isUseCaptcha
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div class="form__footer">
        <div class="form__footer-item button-group button-group--center"><button type="submit" name="web_form_submit" class="button button--accent button--lg" onClick="window.corporateFormMeSending=true">отправить запрос</button></div>
    </div>
    <input type="hidden" name="web_form_apply" value="Y" />
    <?=$arResult["FORM_FOOTER"]?>
</div>
