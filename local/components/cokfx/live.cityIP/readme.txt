определение города по IP

  <? $APPLICATION->IncludeComponent(
        "cokfx:live.cityIP",
        "",
        Array(
            "CACHE_TIME" => "3600",
            "CACHE_TYPE" => "A",
            "IBLOCK_ID" => "44",
            "IBLOCK_TYPE" => "development",
            "ITEMS_LIMIT" => "10"
        )
    ); ?>