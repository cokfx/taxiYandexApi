<?php

$set = array(
	'IS_MOBILE_VERSION' => 'Мобильная версия',
);

$arTemplateParameters = array();
foreach ($set as $k => $val) {
	$arTemplateParameters[$k] = array(
		'NAME' => $val,
		'COLS' => 35,
		'ROWS' => 1
	);
}
