<?php

namespace Composer;

use Composer\Semver\VersionParser;






class InstalledVersions
{
private static $installed = array (
  'root' => 
  array (
    'pretty_version' => 'No version set (parsed as 1.0.0)',
    'version' => '1.0.0.0',
    'aliases' => 
    array (
    ),
    'reference' => NULL,
    'name' => 'mikhail/my-super-project',
  ),
  'versions' => 
  array (
    'dts/ebay-sdk' => 
    array (
      'pretty_version' => '0.1.6',
      'version' => '0.1.6.0',
      'aliases' => 
      array (
      ),
      'reference' => '7a2159991fd41a7ee2da7df95f290f193858ec0d',
    ),
    'dts/ebay-sdk-trading' => 
    array (
      'pretty_version' => '0.14.0',
      'version' => '0.14.0.0',
      'aliases' => 
      array (
      ),
      'reference' => 'c555e69622da46c0efaca7bee63ee89a242beaa0',
    ),
    'guzzle/batch' => 
    array (
      'replaced' => 
      array (
        0 => 'v3.9.3',
      ),
    ),
    'guzzle/cache' => 
    array (
      'replaced' => 
      array (
        0 => 'v3.9.3',
      ),
    ),
    'guzzle/common' => 
    array (
      'replaced' => 
      array (
        0 => 'v3.9.3',
      ),
    ),
    'guzzle/guzzle' => 
    array (
      'pretty_version' => 'v3.9.3',
      'version' => '3.9.3.0',
      'aliases' => 
      array (
      ),
      'reference' => '0645b70d953bc1c067bbc8d5bc53194706b628d9',
    ),
    'guzzle/http' => 
    array (
      'replaced' => 
      array (
        0 => 'v3.9.3',
      ),
    ),
    'guzzle/inflection' => 
    array (
      'replaced' => 
      array (
        0 => 'v3.9.3',
      ),
    ),
    'guzzle/iterator' => 
    array (
      'replaced' => 
      array (
        0 => 'v3.9.3',
      ),
    ),
    'guzzle/log' => 
    array (
      'replaced' => 
      array (
        0 => 'v3.9.3',
      ),
    ),
    'guzzle/parser' => 
    array (
      'replaced' => 
      array (
        0 => 'v3.9.3',
      ),
    ),
    'guzzle/plugin' => 
    array (
      'replaced' => 
      array (
        0 => 'v3.9.3',
      ),
    ),
    'guzzle/plugin-async' => 
    array (
      'replaced' => 
      array (
        0 => 'v3.9.3',
      ),
    ),
    'guzzle/plugin-backoff' => 
    array (
      'replaced' => 
      array (
        0 => 'v3.9.3',
      ),
    ),
    'guzzle/plugin-cache' => 
    array (
      'replaced' => 
      array (
        0 => 'v3.9.3',
      ),
    ),
    'guzzle/plugin-cookie' => 
    array (
      'replaced' => 
      array (
        0 => 'v3.9.3',
      ),
    ),
    'guzzle/plugin-curlauth' => 
    array (
      'replaced' => 
      array (
        0 => 'v3.9.3',
      ),
    ),
    'guzzle/plugin-error-response' => 
    array (
      'replaced' => 
      array (
        0 => 'v3.9.3',
      ),
    ),
    'guzzle/plugin-history' => 
    array (
      'replaced' => 
      array (
        0 => 'v3.9.3',
      ),
    ),
    'guzzle/plugin-log' => 
    array (
      'replaced' => 
      array (
        0 => 'v3.9.3',
      ),
    ),
    'guzzle/plugin-md5' => 
    array (
      'replaced' => 
      array (
        0 => 'v3.9.3',
      ),
    ),
    'guzzle/plugin-mock' => 
    array (
      'replaced' => 
      array (
        0 => 'v3.9.3',
      ),
    ),
    'guzzle/plugin-oauth' => 
    array (
      'replaced' => 
      array (
        0 => 'v3.9.3',
      ),
    ),
    'guzzle/service' => 
    array (
      'replaced' => 
      array (
        0 => 'v3.9.3',
      ),
    ),
    'guzzle/stream' => 
    array (
      'replaced' => 
      array (
        0 => 'v3.9.3',
      ),
    ),
    'mikhail/my-super-project' => 
    array (
      'pretty_version' => 'No version set (parsed as 1.0.0)',
      'version' => '1.0.0.0',
      'aliases' => 
      array (
      ),
      'reference' => NULL,
    ),
    'mmjurov/yandex-inflector' => 
    array (
      'pretty_version' => 'dev-master',
      'version' => 'dev-master',
      'aliases' => 
      array (
        0 => '1.0.x-dev',
      ),
      'reference' => '6fe289a8dad873d3922534b22c2582d81a376367',
    ),
    'psr/log' => 
    array (
      'pretty_version' => '1.1.3',
      'version' => '1.1.3.0',
      'aliases' => 
      array (
      ),
      'reference' => '0f73288fd15629204f9d42b7055f72dacbe811fc',
    ),
    'symfony/event-dispatcher' => 
    array (
      'pretty_version' => 'v2.8.52',
      'version' => '2.8.52.0',
      'aliases' => 
      array (
      ),
      'reference' => 'a77e974a5fecb4398833b0709210e3d5e334ffb0',
    ),
  ),
);







public static function getInstalledPackages()
{
return array_keys(self::$installed['versions']);
}









public static function isInstalled($packageName)
{
return isset(self::$installed['versions'][$packageName]);
}














public static function satisfies(VersionParser $parser, $packageName, $constraint)
{
$constraint = $parser->parseConstraints($constraint);
$provided = $parser->parseConstraints(self::getVersionRanges($packageName));

return $provided->matches($constraint);
}










public static function getVersionRanges($packageName)
{
if (!isset(self::$installed['versions'][$packageName])) {
throw new \OutOfBoundsException('Package "' . $packageName . '" is not installed');
}

$ranges = array();
if (isset(self::$installed['versions'][$packageName]['pretty_version'])) {
$ranges[] = self::$installed['versions'][$packageName]['pretty_version'];
}
if (array_key_exists('aliases', self::$installed['versions'][$packageName])) {
$ranges = array_merge($ranges, self::$installed['versions'][$packageName]['aliases']);
}
if (array_key_exists('replaced', self::$installed['versions'][$packageName])) {
$ranges = array_merge($ranges, self::$installed['versions'][$packageName]['replaced']);
}
if (array_key_exists('provided', self::$installed['versions'][$packageName])) {
$ranges = array_merge($ranges, self::$installed['versions'][$packageName]['provided']);
}

return implode(' || ', $ranges);
}





public static function getVersion($packageName)
{
if (!isset(self::$installed['versions'][$packageName])) {
throw new \OutOfBoundsException('Package "' . $packageName . '" is not installed');
}

if (!isset(self::$installed['versions'][$packageName]['version'])) {
return null;
}

return self::$installed['versions'][$packageName]['version'];
}





public static function getPrettyVersion($packageName)
{
if (!isset(self::$installed['versions'][$packageName])) {
throw new \OutOfBoundsException('Package "' . $packageName . '" is not installed');
}

if (!isset(self::$installed['versions'][$packageName]['pretty_version'])) {
return null;
}

return self::$installed['versions'][$packageName]['pretty_version'];
}





public static function getReference($packageName)
{
if (!isset(self::$installed['versions'][$packageName])) {
throw new \OutOfBoundsException('Package "' . $packageName . '" is not installed');
}

if (!isset(self::$installed['versions'][$packageName]['reference'])) {
return null;
}

return self::$installed['versions'][$packageName]['reference'];
}





public static function getRootPackage()
{
return self::$installed['root'];
}







public static function getRawData()
{
return self::$installed;
}



















public static function reload($data)
{
self::$installed = $data;
}
}
