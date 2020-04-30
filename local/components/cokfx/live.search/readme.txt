ставиум компонент ниже шапки
кнопку с картинкой ставим в шапке по дизайн

  <? $APPLICATION->IncludeComponent(
        "cokfx:live.search",
        "",
        Array(
            "CACHE_TIME" => "3600",
            "CACHE_TYPE" => "A",
            "IBLOCK_ID" => "44",
            "IBLOCK_TYPE" => "development",
            "ITEMS_LIMIT" => "10"
        )
    ); ?>