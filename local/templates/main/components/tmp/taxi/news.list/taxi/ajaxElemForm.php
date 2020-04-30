<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php"); ?>
<?php
ob_start();
global $elemId;

if ($_REQUEST['act'] = 'update' && $_REQUEST['id']) {

    $elemId = $_REQUEST['id'];
}
?>
<? $APPLICATION->IncludeComponent("cab:ext.feedback.form", "taxi", Array(
    "AJAX_MODE" => "Y",    // Включить режим AJAX
    "AJAX_OPTION_ADDITIONAL" => "",    // Дополнительный идентификатор
    "AJAX_OPTION_HISTORY" => "N",    // Включить эмуляцию навигации браузера
    "AJAX_OPTION_JUMP" => "N",    // Включить прокрутку к началу компонента
    "AJAX_OPTION_STYLE" => "Y",    // Включить подгрузку стилей
    "COMPONENT_ID" => "",
    "REDIRECT_URL"=>'/taxi/',
    "CUSTOM_TITLE_CAPTCHA" => "",
    "CUSTOM_TITLE_CAPTCHA_INPUT" => "",
    "CUSTOM_TITLE_DATE_ACTIVE_FROM" => "",
    "CUSTOM_TITLE_DATE_ACTIVE_TO" => "",
    "CUSTOM_TITLE_DETAIL_PICTURE" => "",
    "CUSTOM_TITLE_DETAIL_TEXT" => "",
    "CUSTOM_TITLE_IBLOCK_SECTION" => "",
    "CUSTOM_TITLE_NAME" => "ФИО",
    "CUSTOM_TITLE_PREVIEW_PICTURE" => "",
    "CUSTOM_TITLE_PREVIEW_TEXT" => "",
    "CUSTOM_TITLE_PROP_DRIVER_DATE_AGREE" => "Дата подписания",
    "CUSTOM_TITLE_PROP_DRIVER_ID" => "ID п.п",
    "CUSTOM_TITLE_PROP_DRIVER_PHONES" => "Телефон",
    "CUSTOM_TITLE_PROP_DRIVER_YT" => "ID яндекс",
    "CUSTOM_TITLE_TAGS" => "",
    "DATA-TABLE-COL1-WIDTH" => "40%",    // Ширина первого столбца таблицы
    "DATA-TABLE-COL2-WIDTH" => "60%",    // Ширина второго столбца таблицы
    "DATA-TABLE-LABEL-ALIGN-H" => "l-align",    // Выравнивание метки по горизонтали
    "DATA-TABLE-LABEL-ALIGN-V" => "c-valign",    // Выравнивание метки по вертикали
    "DATA-TABLE-WIDTH" => "100%",    // Ширина таблицы
    "DEFAULT_INPUT_SIZE" => "30",    // Размер полей ввода
    "DETAIL_TEXT_USE_HTML_EDITOR" => "N",    // Использовать визуальный редактор для редактирования подробного текста
    "EFBF_FORM_WIDTH" => "",    // Ширина формы
    "ELEMENT_ASSOC" => "CREATED_BY",    // Привязка к пользователю
    "ERROR_MESSAGES_POSITION" => "UNDER",    // Расположение сообщений об ошибках
    "FIELD_ERRMSG" => "N",    // Установить собственные сообщения об ошибках
    "FIELD_ERROR_POSITION" => "Y",    // Сообщения об ошибках рядом с полями ввода данных
    "FIELD_ORDER" => "N",    // Установить порядок вывода полей
    "FIELD_PREDEF" => "N",    // Установить начальные значения полей
    "FIELD_SELF_NAMES" => "N",    // Установить собственные наименования полей
    "FIELD_VALID" => "N",    // Установить регулярные выражения для проверки ввода значений полей
    "FORM_CODE" => "",    // Форма
    "FORM_NAME" => "",    // Заголовок формы
    "GROUPS" => "",    // Группы пользователей, имеющие право на доступ к форме
    "IBLOCK_ELEMENT_ID" => $elemId,    // ID элемента
    "IBLOCK_ID" => "26",    // Инфо-блок
    "IBLOCK_TYPE" => "taxi",    // Тип инфо-блока
    "INPUT_AS_PASSWORD" => "",    // Поле для ввода пароля
    "INPUT_AS_PASSWORD_CONFIRM" => "Y",    // Подтверждение ввода пароля
    "MAX_FILE_SIZE" => "0",    // Максимальный размер загружаемых файлов, байт (0 - не ограничивать)
    "MAX_LEVELS" => "100000",    // Ограничить кол-во рубрик, в которые можно добавлять элемент
    "NEED_JQUERY" => "",    // Подключить библиотеку JQuery
    "PREVIEW_TEXT_USE_HTML_EDITOR" => "N",    // Использовать визуальный редактор для редактирования текста анонса
    "PROPERTY_CODES" => array("NAME", "PROP_DRIVER_DATE_AGREE", "PROP_ID_ELEMENT", "PROP_LAST_NAME_PAYEE", "PROP_FIRST_NAME_PAYEE", "PROP_MIDDLE_NAME_PAYEE", "PROP_DRIVER_ID", "PROP_DRIVER_YT", "PROP_DRIVER_PHONES"),
    "PROPERTY_CODES_REQUIRED" => array("PROP_DRIVER_DATE_AGREE", "PROP_LAST_NAME_PAYEE", "PROP_FIRST_NAME_PAYEE", "PROP_MIDDLE_NAME_PAYEE"),    // Свойства, обязательные для заполнения
    "RESIZE_IMAGES" => "N",    // Использовать настройки инфоблока для обработки изображений
    "SAVE_TO_IB" => "Y",    // Сохранить сообщение в инфоблоке
    "SEND_MESSAGE" => "N",    // Отправлять сообщение
    "USER_MESSAGE_ADD" => "",    // Сообщение об успешной операции
    "USER_SEND_MESSAGE" => "N",    // Отправлять сообщение пользователю
    "USE_CAPTCHA" => "N",    // Использовать CAPTCHA
    "USE_CAPTCHA_REFRESH" => "Y",    // Использовать AJAX обновление CAPTCHA
    "USE_TEXT_FOR_HTML" => "",    // Не использовать визуальный редактор для выбранных полей
    "COMPONENT_TEMPLATE" => "taxi",
    "FILES_MIN_CNT_PROP_DS_FILES" => "5",    // [DS_FILES] ФАЙЛ, мин. кол-во
    "FILES_MIN_CNT_PROP_S_FILES" => "5",    // [S_FILES] Файлы, мин. кол-во
    "LIST_NOT_ESTABLISHED_PROP_SEL" => "Y",    // [SEL] select (выводить "не установлено")
),
    false
); ?>
<?php
$html = ob_get_contents();
ob_end_clean();

$res = array(
    'html' => $html,

);
//echo \Bitrix\Main\Web\Json::encode($res);
die();