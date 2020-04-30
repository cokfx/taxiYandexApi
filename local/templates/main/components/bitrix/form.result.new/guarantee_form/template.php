<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<div data-form="SIMPLE_FORM_7" data-ajax="true" <?/*data-success="false"
     data-popup-type="success-FORM"*/?> class="js-form">
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
    <ol class="guarantee-form__list">
        <li class="guarantee-form__item">
            <div class="guarantee-form__itemQuestion">Укажите, пожалуйста, источник информации о Гарантиях клиники:</div>
            <div class="guarantee-form__itemAnswers guarantee-form__itemAnswers--vertical">
                <div class="guarantee-form__itemAnswer">
                    <label class="label label--radio">
                        <input type="radio" name="form_radio_SIMPLE_QUESTION_231" value="33" checked><span class="icon icon--radio"></span><span class="label__text">Врач на приеме</span>
                    </label>
                </div>
                <div class="guarantee-form__itemAnswer">
                    <label class="label label--radio">
                        <input type="radio" name="form_radio_SIMPLE_QUESTION_231" value="34"><span class="icon icon--radio"></span><span class="label__text">Информационные стенды в клинике</span>
                    </label>
                </div>
                <div class="guarantee-form__itemAnswer">
                    <label class="label label--radio">
                        <input type="radio" name="form_radio_SIMPLE_QUESTION_231" value="35"><span class="icon icon--radio"></span><span class="label__text">Интернет-сайт</span>
                    </label>
                </div>
                <div class="guarantee-form__itemAnswer">
                    <label class="label label--radio">
                        <input type="radio" name="form_radio_SIMPLE_QUESTION_231" value="36"><span class="icon icon--radio"></span><span class="label__text">Полиграфическая продукция</span>
                    </label>
                </div>
            </div>
        </li>
        <li class="guarantee-form__item">
            <div class="guarantee-form__itemQuestion">Сопровождали ли Вас сотрудники клиники до нужного кабинета и помогали ли ориентироваться в Клинике?</div>
            <div class="guarantee-form__itemAnswers">
                <div class="guarantee-form__itemAnswer">
                    <label class="label label--radio">
                        <input type="radio" name="form_radio_SIMPLE_QUESTION_170" value="37" checked><span class="icon icon--radio"></span><span class="label__text">Да</span>
                    </label>
                </div>
                <div class="guarantee-form__itemAnswer">
                    <label class="label label--radio">
                        <input type="radio" name="form_radio_SIMPLE_QUESTION_170" value="38"><span class="icon icon--radio"></span><span class="label__text">Нет</span>
                    </label>
                </div>
            </div>
        </li>
        <li class="guarantee-form__item">
            <div class="guarantee-form__itemQuestion">Мы работаем в соответствии с Медицинскими Стандартами. Объяснил ли Вам врач, что это значит лично для Вас?</div>
            <div class="guarantee-form__itemAnswers">
                <div class="guarantee-form__itemAnswer">
                    <label class="label label--radio">
                        <input type="radio" name="form_radio_SIMPLE_QUESTION_225" value="39" checked><span class="icon icon--radio"></span><span class="label__text">Да</span>
                    </label>
                </div>
                <div class="guarantee-form__itemAnswer">
                    <label class="label label--radio">
                        <input type="radio" name="form_radio_SIMPLE_QUESTION_225" value="40"><span class="icon icon--radio"></span><span class="label__text">Нет</span>
                    </label>
                </div>
            </div>
        </li>
        <li class="guarantee-form__item">
            <div class="guarantee-form__itemQuestion">Имели ли Вы возможность, при Вашем желании, получить на руки результаты выполненных диагностических исследований, записанные на СD-диски?</div>
            <div class="guarantee-form__itemAnswers">
                <div class="guarantee-form__itemAnswer">
                    <label class="label label--radio">
                        <input type="radio" name="form_radio_SIMPLE_QUESTION_973" value="41"><span class="icon icon--radio"></span><span class="label__text">Да</span>
                    </label>
                </div>
                <div class="guarantee-form__itemAnswer">
                    <label class="label label--radio">
                        <input type="radio" name="form_radio_SIMPLE_QUESTION_973" value="42"><span class="icon icon--radio"></span><span class="label__text">Нет</span>
                    </label>
                </div>
                <div class="guarantee-form__itemAnswer">
                    <label class="label label--radio">
                        <input type="radio" name="form_radio_SIMPLE_QUESTION_973" value="43" checked><span class="icon icon--radio"></span><span class="label__text">Не было необходимости</span>
                    </label>
                </div>
            </div>
        </li>
        <li class="guarantee-form__item">
            <div class="guarantee-form__itemQuestion">Если Вам проводилось оперативное вмешательство под наркозом, была ли Вам выдана видеозапись оперативного вмешательства?</div>
            <div class="guarantee-form__itemAnswers">
                <div class="guarantee-form__itemAnswer">
                    <label class="label label--radio">
                        <input type="radio" name="form_radio_SIMPLE_QUESTION_868" value="44" checked><span class="icon icon--radio"></span><span class="label__text">Да</span>
                    </label>
                </div>
                <div class="guarantee-form__itemAnswer">
                    <label class="label label--radio">
                        <input type="radio" name="form_radio_SIMPLE_QUESTION_868" value="45"><span class="icon icon--radio"></span><span class="label__text">Нет</span>
                    </label>
                </div>
                <div class="guarantee-form__itemAnswer">
                    <label class="label label--radio">
                        <input type="radio" name="form_radio_SIMPLE_QUESTION_868" value="46"><span class="icon icon--radio"></span><span class="label__text">Не проводилось</span>
                    </label>
                </div>
            </div>
        </li>
        <li class="guarantee-form__item">
            <div class="guarantee-form__itemQuestion">Выдал ли Вам врач рекомендации по санаторно-курортному лечению?</div>
            <div class="guarantee-form__itemAnswers">
                <div class="guarantee-form__itemAnswer">
                    <label class="label label--radio">
                        <input type="radio" name="form_radio_SIMPLE_QUESTION_284" value="47" checked><span class="icon icon--radio"></span><span class="label__text">Да</span>
                    </label>
                </div>
                <div class="guarantee-form__itemAnswer">
                    <label class="label label--radio">
                        <input type="radio" name="form_radio_SIMPLE_QUESTION_284" value="48"><span class="icon icon--radio"></span><span class="label__text">Нет</span>
                    </label>
                </div>
            </div>
        </li>
        <li class="guarantee-form__item">
            <div class="guarantee-form__itemQuestion">Выдал ли Вам врач после приема письменные рекомендации?</div>
            <div class="guarantee-form__itemAnswers">
                <div class="guarantee-form__itemAnswer">
                    <label class="label label--radio">
                        <input type="radio" name="form_radio_SIMPLE_QUESTION_585" value="49" checked><span class="icon icon--radio"></span><span class="label__text">Да</span>
                    </label>
                </div>
                <div class="guarantee-form__itemAnswer">
                    <label class="label label--radio">
                        <input type="radio" name="form_radio_SIMPLE_QUESTION_585" value="50"><span class="icon icon--radio"></span><span class="label__text">Нет</span>
                    </label>
                </div>
            </div>
        </li>
        <li class="guarantee-form__item">
            <div class="guarantee-form__itemQuestion">Знаете ли Вы о том, что в случае обоснованной претензии Вы можете получить материальную компенсацию?</div>
            <div class="guarantee-form__itemAnswers">
                <div class="guarantee-form__itemAnswer">
                    <label class="label label--radio">
                        <input type="radio" name="form_radio_SIMPLE_QUESTION_874" value="51" checked><span class="icon icon--radio"></span><span class="label__text">Да</span>
                    </label>
                </div>
                <div class="guarantee-form__itemAnswer">
                    <label class="label label--radio">
                        <input type="radio" name="form_radio_SIMPLE_QUESTION_874" value="52"><span class="icon icon--radio"></span><span class="label__text">Нет</span>
                    </label>
                </div>
            </div>
        </li>
        <li class="guarantee-form__item">
            <div class="guarantee-form__itemQuestion">Как Вы оцениваете свою неудовлетворенность?</div>
            <div class="guarantee-form__itemAnswers">
                <div class="guarantee-form__itemAnswer">
                    <label class="label label--radio">
                        <input type="radio" name="form_radio_SIMPLE_QUESTION_230" value="53"><span class="icon icon--radio"></span><span class="label__text">3 500 рублей</span>
                    </label>
                </div>
                <div class="guarantee-form__itemAnswer">
                    <label class="label label--radio">
                        <input type="radio" name="form_radio_SIMPLE_QUESTION_230" value="54"><span class="icon icon--radio"></span><span class="label__text">7 000 руб</span>
                    </label>
                </div>
                <div class="guarantee-form__itemAnswer">
                    <label class="label label--radio">
                        <input type="radio" name="form_radio_SIMPLE_QUESTION_230" value="55" checked><span class="icon icon--radio"></span><span class="label__text">Претензий нет</span>
                    </label>
                </div>
            </div>
        </li>
        <li class="guarantee-form__item">
            <div class="guarantee-form__itemQuestion">Имели ли Вы возможность получать диагностические услуги в день обращения?</div>
            <div class="guarantee-form__itemAnswers">
                <div class="guarantee-form__itemAnswer">
                    <label class="label label--radio">
                        <input type="radio" name="form_radio_SIMPLE_QUESTION_978" value="56" checked><span class="icon icon--radio"></span><span class="label__text">Да</span>
                    </label>
                </div>
                <div class="guarantee-form__itemAnswer">
                    <label class="label label--radio">
                        <input type="radio" name="form_radio_SIMPLE_QUESTION_978" value="57"><span class="icon icon--radio"></span><span class="label__text">Нет</span>
                    </label>
                </div>
            </div>
        </li>
        <li class="guarantee-form__item">
            <div class="guarantee-form__itemQuestion">Знаете ли вы своего лечащего врача (терапевта, педиатра)?</div>
            <div class="guarantee-form__itemAnswers">
                <div class="guarantee-form__itemAnswer">
                    <label class="label label--radio">
                        <input type="radio" name="form_radio_SIMPLE_QUESTION_900" value="58" checked><span class="icon icon--radio"></span><span class="label__text">Да</span>
                    </label>
                </div>
                <div class="guarantee-form__itemAnswer">
                    <label class="label label--radio">
                        <input type="radio" name="form_radio_SIMPLE_QUESTION_900" value="59"><span class="icon icon--radio"></span><span class="label__text">Нет</span>
                    </label>
                </div>
            </div>
        </li>
        <li class="guarantee-form__item">
            <div class="guarantee-form__itemQuestion">На сколько Вы оцениваете качество медицинского обслуживания в целом (по пятибалльной шкале)?</div>
            <div class="guarantee-form__itemAnswers">
                <div class="guarantee-form__itemAnswer">
                    <label class="label label--radio">
                        <input type="radio" name="form_radio_SIMPLE_QUESTION_655" value="60"><span class="icon icon--radio"></span><span class="label__text">1</span>
                    </label>
                </div>
                <div class="guarantee-form__itemAnswer">
                    <label class="label label--radio">
                        <input type="radio" name="form_radio_SIMPLE_QUESTION_655" value="61"><span class="icon icon--radio"></span><span class="label__text">2</span>
                    </label>
                </div>
                <div class="guarantee-form__itemAnswer">
                    <label class="label label--radio">
                        <input type="radio" name="form_radio_SIMPLE_QUESTION_655" value="62"><span class="icon icon--radio"></span><span class="label__text">3</span>
                    </label>
                </div>
                <div class="guarantee-form__itemAnswer">
                    <label class="label label--radio">
                        <input type="radio" name="form_radio_SIMPLE_QUESTION_655" value="63"><span class="icon icon--radio"></span><span class="label__text">4</span>
                    </label>
                </div>
                <div class="guarantee-form__itemAnswer">
                    <label class="label label--radio">
                        <input type="radio" name="form_radio_SIMPLE_QUESTION_655" value="64" checked><span class="icon icon--radio"></span><span class="label__text">5</span>
                    </label>
                </div>
            </div>
        </li>
    </ol>
    <div class="guarantee-form__info">
        <div class="guarantee-form__infoBlock">
            <div class="guarantee-form__infoBlock-title">Мы хотим, чтобы вы знали о наших ГАРАНТИЯХ и были уверены в их исполнении!</div>
            <div class="guarantee-form__infoBlock-text">Если Вы заметили какое-либо несоответствие фактически предоставляемого обслуживания, утвержденным <a href="/o-klinike/garantii-kliniki/" target="_blank" class="link">гарантиям клиники ОАО «МЕДИЦИНА»</a>, просим сообщить нам об этом. Это будет являться существенной помощью нам в обеспечении высокого качества медицинского обслуживания.</div>
        </div>
        <div class="guarantee-form__infoBlock">
            <div class="guarantee-form__infoBlock-title">Пожалуйста, оставьте любые комментарии!</div>
            <div class="guarantee-form__infoBlock-subText">(при желании, сообщите, пожалуйста, Ф.И.О. и свою контактную информацию):</div>
        </div>
    </div>
    <div class="guarantee-form__footer">
        <div class="form-group">
            <textarea name="form_textarea_65" class="form-control guarantee-form__textarea" rows="5" placeholder="Ваш комментарий"></textarea>
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
        <div class="guarantee-form__button">
            <button name="web_form_submit" class="button button--lg" type="submit" onClick="window.guaranteeFormSending=true">Отправить</button>
        </div>
    </div>
    <input type="hidden" name="web_form_apply" value="Y" />
    <?=$arResult["FORM_FOOTER"]?>
</div>
