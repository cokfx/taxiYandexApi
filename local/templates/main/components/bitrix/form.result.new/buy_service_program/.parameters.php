<?php

$set = array(
	'PROGRAM_ID' => 'ID программы обслуживания',
	'AGE_FROM' => 'Установить возраст от',
	'AGE_TO' => 'Установить возраст до',
);

$arTemplateParameters = array();
foreach ($set as $k => $val) {
	$arTemplateParameters[$k] = array(
		'NAME' => $val,
		'COLS' => 35,
		'ROWS' => 1
	);
}
