<?php

$set = array(
	'PROGRAM_NAME' => 'Название семинара',
	'PRICE' => 'Расчетная сумма',
);

$arTemplateParameters = array();
foreach ($set as $k => $val) {
	$arTemplateParameters[$k] = array(
		'NAME' => $val,
		'COLS' => 35,
		'ROWS' => 1
	);
}
