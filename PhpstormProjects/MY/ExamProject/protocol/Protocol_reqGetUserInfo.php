<?php
/**
 * Created by PhpStorm.
 * User: 이창선
 * Date: 2018-01-19
 * Time: 오후 3:13
 */

class Protocol_reqGetUserInfo implements ProtocolInterface
{
    // 유저 정보 조회
    public function handle($params)
    {
        global $database;
        $result = [];

        $query = "select * from user where userId = {$params[Constant::USER_ID]}";
        $stmt = $database->query($query);

        // 조회된 정보가 있을 경우에만 값 설정
        if ($stmt->rowCount() == 0) {
            $result[Constant::USER_INDEX] = 0;
            $result[Constant::NICKNAME] = '';
            $result[Constant::ADD_DATE] = '';
            $result[Constant::MOD_DATE] = '';
        } else {
            foreach ($stmt as $row) {
                $result[Constant::USER_INDEX] = $row[Constant::USER_INDEX];
                $result[Constant::NICKNAME] = $row[Constant::NICKNAME];
                $result[Constant::ADD_DATE] = $row[Constant::ADD_DATE];
                $result[Constant::MOD_DATE] = $row[Constant::MOD_DATE];
            }
        }

        return $result;
    }
}