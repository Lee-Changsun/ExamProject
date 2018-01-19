<?php
/**
 * Created by PhpStorm.
 * User: 이창선
 * Date: 2018-01-19
 * Time: 오후 1:42
 */

class Protocol_reqCreateUser implements ProtocolInterface{
    
    // 유저 생성
    public function handle($params)
    {
        global $database;
        $result = null;

        $query = "insert into user(userid, nickname, mod_date) values({$params[Constant::USER_ID]}, '{$params[Constant::NICKNAME]}', now())";
        $stmt = $database->query($query);

        // 성공했을 경우에만 수행, 실패 했을 시 null값 리턴
        if($stmt !== false){
            $query = "select userIdx from user where userid = {$params[Constant::USER_ID]}";
            $stmt = $database->query($query);

            foreach($stmt as $row){
                $result = $row[Constant::USER_INDEX];
            }
        }



        return $result;
    }

}