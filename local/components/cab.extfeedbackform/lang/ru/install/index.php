<?
	$MESS['cab.extfeedbackform_MODULE_NAME'] = 'Модуль "Расширенная форма обратной связи"';
	$MESS['cab.extfeedbackform_MODULE_DESC'] = 'Расширенная форма обратной связи с сохранением сообщений и учетом статистики';
	$MESS['cab.extfeedbackform_PARTNER_NAME'] = 'Cab Софт';
	$MESS['cab.extfeedbackform_PARTNER_URI'] = 'http://cab-soft.ru';
	
	$MESS['cab.extfeedbackform_INSTALL_TITLE'] = 'Устновка модуля';
	$MESS['cab.extfeedbackform_DELETE_TITLE'] = 'Удаление модуля';
	
	$MESS['cab.extfeedbackform_EVENT_NAME'] = 'Отправка сообщения через расширенную форму обратной связи (Cab Софт)';
	$MESS['cab.extfeedbackform_USER_EVENT_NAME'] = 'Отправка уведомления пользователю с сообщением из расширенной формы обратной связи (Cab Софт)';
	
	$MESS['cab.extfeedbackform_EVENT_DESCRIPTION'] = 'Тип события для отправки сообщения пользователю через расширенную форму обратной связи (Cab Софт)
#USER_FIO# - ФИО пользователя, заполнившего форму
#USER_ID# - ID пользователя, заполнившего форму
#<свойство элемента инфоблока># - Введенное пользователем значение поля формы, соответствующего свойству элемента инфоблока
#PROPERTY_<свойство элемента инфоблока>_TEXT# - Введенное пользователем значение поля формы, соответствующего пользовательскому свойству элемента инфоблока
#IBLOCK_ID# - ID инфоблока
#IBLOCK_ELEMENT_ID# - ID элемента инфоблока';

	$MESS['cab.extfeedbackform_USER_EVENT_DESCRIPTION'] = 'Тип события для отправки уведомления пользователю с сообщением из расширенной формы обратной связи (Cab Софт)
#USER_FIO# - ФИО пользователя, заполнившего форму
#USER_ID# - ID пользователя, заполнившего форму
#<свойство элемента инфоблока># - Введенное пользователем значение поля формы, соответствующего свойству элемента инфоблока
#PROPERTY_<свойство элемента инфоблока>_TEXT# - Введенное пользователем значение поля формы, соответствующего пользовательскому свойству элемента инфоблока
#USER_EMAIL_TO# - Email пользователя';

	$MESS['cab.extfeedbackform_EVENT_TEMPLATE_SUBJECT'] = 'Сообщение через форму обратной связи';
	$MESS['cab.extfeedbackform_USER_EVENT_TEMPLATE_SUBJECT'] = 'Сообщение на сайте #SITE_NAME#';
	
	$MESS['cab.extfeedbackform_EVENT_TEMPLATE_MESSAGE'] = '
Сообщение с сайта #SITE_NAME#.

Пользователь #USER_FIO# (ID=#USER_ID#)отправил сообщение:
#PREVIEW_TEXT#

Тема: #NAME#';	
	
	$MESS['cab.extfeedbackform_USER_EVENT_TEMPLATE_MESSAGE'] = '
Вы отправили сообщение на сайте #SITE_NAME#:
#PREVIEW_TEXT#

Тема: #NAME#';	
	
	$MESS['MOD_INST_RUN'] = 'Установить';
	$MESS['MOD_UNINST_SAVE'] = 'Сохранить данные (таблицы, почтовые события, почтовые шаблоны)';
	$MESS['MOD_UNINST_SAVE_DATA'] = 'Сохранить данные';	
	
	$MESS['MOD_INFO'] = '
		1. Управление модулем располагается в разделе "Сервисы": <a target="_blank" href="/bitrix/admin/cab.extfeedbackform_efbf_index.php">"Сервисы" > "Cab Софт" > "Форма обратной связи".</a><br/>
		2.Добавление гаджета с информацией о динамике использования формы обратной связи : на <a target="_blank" href="/bitrix/admin/">рабочем столе</a> выбрать "Добавить гаджет" > "Прочие" > "Cab Софт: Динамика использования формы обратной связи".<br/>
		3. Почтовый шаблон для отправки сообщения можно отредактировать <a target="_blank" href="/bitrix/admin/message_admin.php?find_event_type=CAB_EXT_FEEDBACK_FORM_EVENT">здесь</a>.<br/>
		4. Компонент "Расширенная форма обратной связи" находится на панели компонентов в разделе "Cab Софт".
	';	
	
?>