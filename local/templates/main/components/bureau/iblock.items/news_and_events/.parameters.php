<?php

$set = array(
	'IS_AJAX_REQUEST' => 'Ajax-шаблон',
	'LOAD_MORE_TEXT' => 'Текст для кнопки подгрузки элементов',
);


$arTemplateParameters = array();
foreach ($set as $k => $val) {
	$arTemplateParameters[$k] = array(
		'NAME' => $val,
		'COLS' => 5,
		'ROWS' => 1
	);
}
