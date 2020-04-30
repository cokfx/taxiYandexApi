<?php
require __DIR__ . '/artifacts/dts-trading.phar';

$service = new \DTS\eBaySDK\Trading\Services\TradingService(array(
    'apiVersion' => '123'
));

echo 'Version=' . \DTS\eBaySDK\Trading\Services\TradingService::VERSION;
