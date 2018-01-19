<?php
/**
 * Created by PhpStorm.
 * User: 이창선
 * Date: 2018-01-19
 * Time: 오전 11:35
 */

class Initialization{

    public static function init(){
        global $database;

        if($database === null){
            $database = new Database(Constant::DB_HOST, Constant::DB_PORT, Constant::DB_NAME, Constant::DB_USER, Constant::DB_PW, Constant::DB_CHARSET);
        }
    }
}