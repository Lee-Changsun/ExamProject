<?php
/**
 * Created by PhpStorm.
 * User: 이창선
 * Date: 2018-01-18
 * Time: 오후 7:32
 */

class Protocol{
    const IDLE = 1;
    const GAP = 1000;

    // 요청프로토콜
    const REQ_TEST = "reqTest";
    const REQ_CREATE_USER = "reqCreateUser";
    const REQ_GET_USER_INFO = "reqGetUserInfo";
    const REQ_UPDATE_USER_INFO = "reqUpdateUserInfo";

    // 응답 프로토콜
    const RES_TEST = "resTest";
    const RES_CREATE_USER = "resCreateUser";
    const RES_GET_USER_INFO = "resGetUserInfo";
    const RES_UPDATE_USER_INFO = "resUpdateUserInfo";

    // 요청응답 프로토콜 매핑 요청 + GAP = 응답
    const PROTO_MAPPING = [
        Protocol::REQ_TEST => 10,
        Protocol::REQ_CREATE_USER => 11,
        Protocol::REQ_GET_USER_INFO => 12,
        Protocol::REQ_UPDATE_USER_INFO => 13,

        1010 => Protocol::RES_TEST,
        1011 => Protocol::RES_CREATE_USER,
        1012 => Protocol::RES_GET_USER_INFO,
        1013 => Protocol::RES_UPDATE_USER_INFO
    ];
}