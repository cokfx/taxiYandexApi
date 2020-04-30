<?php

$set = array(
	'NAME' => 'ФИО Президента клиники',
	'DESCRIPTION' => 'Описательный текст',
	'POSITION' => 'Должность (текст синего цвета)',
	'IMAGE_LINK' => 'Ссылка на фотографию относительно корня сайта',
);

$arTemplateParameters = array();
foreach ($set as $k => $val) {
	$arTemplateParameters[$k] = array(
		'NAME' => $val,
		'COLS' => 35,
		'ROWS' => 1
	);
}
