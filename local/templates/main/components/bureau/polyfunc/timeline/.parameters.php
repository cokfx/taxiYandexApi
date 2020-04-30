<?php

$set = array(
	'IBLOCK_ID' => 'ID инфоблока'
);

$arTemplateParameters = array();
foreach ($set as $k => $val) {
	$arTemplateParameters[$k] = array(
		'NAME' => $val,
		'COLS' => 35,
		'ROWS' => 1
	);
}
