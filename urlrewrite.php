<?php
$arUrlRewrite=array (
  5 => 
  array (
    'CONDITION' => '#^/objects/where_visit/istoricheskaya-liniya/(\\\\?(.*))?#',
    'RULE' => '',
    'ID' => '',
    'PATH' => '/historical_line/index.php',
    'SORT' => 100,
  ),
  0 => 
  array (
    'CONDITION' => '#^\\/?\\/mobileapp/jn\\/(.*)\\/.*#',
    'RULE' => 'componentName=$1',
    'ID' => NULL,
    'PATH' => '/bitrix/services/mobileapp/jn.php',
    'SORT' => 100,
  ),
  6 => 
  array (
    'CONDITION' => '#^/audio-guide/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/historical_line/index.php',
    'SORT' => 100,
  ),
  9 => 
  array (
    'CONDITION' => '#^/souvenirs/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/souvenirs/index.php',
    'SORT' => 100,
  ),
  7 => 
  array (
    'CONDITION' => '#^/objects/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/objects/index.php',
    'SORT' => 100,
  ),
  8 => 
  array (
    'CONDITION' => '#^/events/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/events/index.php',
    'SORT' => 100,
  ),
);
