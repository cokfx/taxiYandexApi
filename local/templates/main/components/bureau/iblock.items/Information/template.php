<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<div class="professions professions--services layout">
    <div class="professions__content">
		<div class="professions__wrap professions__wrap--four">
			<?foreach($arResult['COLUMNS'] as $colItems):?>
				<div class="professions__item">
					<ul class="professions__list">
						<?foreach($colItems as $item):?>
							<li class="professions__list-item">
								<a class="link" href="<?=$item['DETAIL_PAGE_URL']?>"><?=$item['NAME']?></a>
								<?/*<a class="link" <?if($item['PROPERTIES']['EXTERNAL']['VALUE_XML_ID']=="Y"):?>target="_blank"<?endif?> href="<?=$item['PROPERTIES']['URL']['~VALUE']?>"><?=$item['NAME']?></a>*/?>
							</li>
						<?endforeach?>
					</ul>
				</div>
			<?endforeach?>
		</div>
		
		<?/*
		<div class="professions__wrap professions__wrap--four">
            <?
            $lettersCnt = count($arResult['SERVICES']);
            foreach ($arResult['SERVICES'] as $letter => $letterSERVICES):
            ++$letterNum;
            ?>
            <div class="professions__item">
                <div class="professions__title"><?=$letter?></div>
                <ul class="professions__list">
                    <? foreach ($letterSERVICES as $specialty): ?>
                        <li class="professions__list-item">
                            <a class="link" href="<?=$specialty['DETAIL_PAGE_URL']?>"><?=$specialty['NAME']?></a>
                        </li>
                    <? endforeach; ?>
                </ul>
            </div>
            <? if($letterNum % 4 == 0 && $letterNum <= $lettersCnt): ?>
        </div>
        <div class="professions__wrap professions__wrap--four">
            <? endif; ?>
            <? endforeach; ?>
        </div>
		*/?>
    </div>
</div>