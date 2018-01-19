<?php
/**
 * Created by PhpStorm.
 * User: 이창선
 * Date: 2018-01-19
 * Time: 오후 12:17
 */

class Util{

    public static function getCurrDateTime($timestamp){
        return date(Constant::DATE_TIME_FORMAT, $timestamp);
    }

    public static function getDateTime(){
        return date(Constant::DATE_TIME_FORMAT, time());
    }
}