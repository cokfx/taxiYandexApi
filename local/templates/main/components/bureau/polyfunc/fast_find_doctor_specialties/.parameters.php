<?php

$set = array(
	'EXT_CLASSES' => 'Дополнительные классы для select',
    'ADDITIONAL_FILTER' => 'Дополнительный фильтр специальностей',
);

$arTemplateParameters = array();
foreach ($set as $k => $val) {
	$arTemplateParameters[$k] = array(
		'NAME' => $val,
		'COLS' => 35,
		'ROWS' => 1
	);
}
