<?php
\Bitrix\Main\Loader::includeModule("site.main");

function console_log($data)
{
    echo '<script>';
    echo 'console.log(' . json_encode($data) . ')';
    echo '</script>';
}
