<?php
include __DIR__ . '/events.php';
include __DIR__ . '/constants.php';

spl_autoload_register(function ($class){
    if ($class == 'QRcode') {
        require_once __DIR__.'/lib/external/phpqrcode/loader.php';
    }
},false,true);