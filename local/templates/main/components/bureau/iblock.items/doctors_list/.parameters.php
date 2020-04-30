<?php

$set = array(
	'IS_AJAX_REQUEST' => 'Ajax-шаблон',
);


$arTemplateParameters = array();
foreach ($set as $k => $val) {
	$arTemplateParameters[$k] = array(
		'NAME' => $val,
		'COLS' => 5,
		'ROWS' => 1
	);
}
