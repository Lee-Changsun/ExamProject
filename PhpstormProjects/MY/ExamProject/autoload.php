<?php
/**
 * Created by PhpStorm.
 * User: 이창선
 * Date: 2018-01-18
 * Time: 오후 6:45
 */

date_default_timezone_set('Asia/Seoul');

// for class
spl_autoload_register(function ($class){
    $file = __DIR__ . '/class/' .$class.'.php';

    if(!file_exists($file)){
        return;
    }

    require_once $file;
});

// for protocol_
spl_autoload_register(function ($class){
    $file = __DIR__ . '/protocol/' .$class.'.php';

    if(!file_exists($file)){
        return;
    }

    require_once $file;
});

