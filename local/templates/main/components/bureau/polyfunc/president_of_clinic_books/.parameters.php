<?php

$set = array(
	'TITLE' => 'Описательный заголовок кнопки перехода',
	'BUTTON_TEXT' => 'Текст кнопки перехода',
	'BUTTON_LINK' => 'Ссылка для кнопки перехода'
);

$arTemplateParameters = array();
foreach ($set as $k => $val) {
	$arTemplateParameters[$k] = array(
		'NAME' => $val,
		'COLS' => 35,
		'ROWS' => 1
	);
}
