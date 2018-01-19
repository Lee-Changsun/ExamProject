<?php
/**
 * Created by PhpStorm.
 * User: 이창선
 * Date: 2018-01-19
 * Time: 오후 3:36
 */

class Protocol_reqUpdateUserInfo implements ProtocolInterface
{
    // 유저정보 업데이트
    public function handle($params)
    {
        global $database;
        $result = [];

        $query = "update user set nickname = '{$params[Constant::NICKNAME]}', mod_date = now() where userId = {$params[Constant::USER_ID]} ";
        $stmt = $database->exec($query);

        // 성공 했을 시에만 값 조회 후 설정
        if ($stmt === 0) {
            $result[Constant::USER_INDEX] = 0;
            $result[Constant::NICKNAME] = '';
            $result[Constant::MOD_DATE] = '';
        } else {
            $query = "select userIdx, nickname, mod_date from user where userId = {$params[Constant::USER_ID]}";

            foreach($stmt = $database->query($query) as $row){
                $result[Constant::USER_INDEX] = $row[Constant::USER_INDEX];
                $result[Constant::NICKNAME] = $row[Constant::NICKNAME];
                $result[Constant::MOD_DATE] = $row[Constant::MOD_DATE];
            }
        }

        return $result;
    }
}