<?php
/**
 * Created by PhpStorm.
 * User: 이창선
 * Date: 2018-01-18
 * Time: 오후 7:09
 */

class Controller
{

    public function run($requestData)
    {
        // 응닶 값
        $result = [];

        // 프로토콜
        $protocol = '';

        // 파라미터
        $params = null;

        // 프로토콜 인스턴스
        $protocolInstance = false;

        $tmp = null;

        // 모든 파라미터 존재 여부
        $isAllParam = true;

        // 사용할 파라미터 이름
        $paramNames = [];

        // 프로토콜 설정 여부
        if (isset($requestData[Constant::PROTOCOL]) === TRUE) {
            $protocol = $requestData[Constant::PROTOCOL];
        }

        // 프로토콜 값이 빈값 이면
        if (empty($protocol) === TRUE) {
            $result[Constant::PROTOCOL] = "";
            $result[Constant::ERRNO] = Errno::ERROR_PROTOCOL_VALUE_EMPTY;

            return $result;
        }

        // 타임스탬프
        $params[Constant::TIMESTAMP] = time();

        // 프로토콜 인스턴스 설정
        $protocolInstance = $this->getProtocol($protocol);

        switch ($protocol) {
            case Protocol::REQ_TEST: 
                $inputData = [];
                
                // 파라미터 이름 설정
                $paramNames = [Constant::TIMESTAMP, Constant::CUR_DATE, Constant::INPUT_NUMBER];

                // 파라미터 가져오기
                $isAllParam = $this->getParam($inputData, $requestData, $paramNames);

                // 모든 파라미터가 존재할 경우에만
                if ($isAllParam) {
                    $params[Constant::INPUT_DATA] = $inputData;
                    $result = $protocolInstance->handle($params);

                    $result[Constant::CUR_DATE] = Util::getCurrDateTime($params[Constant::TIMESTAMP]);
                }
                break;
            case Protocol::REQ_CREATE_USER: // 유저 생성
                $paramNames = [Constant::USER_ID, Constant::NICKNAME];

                $isAllParam = $this->getParam($params, $requestData, $paramNames);

                // 모든 파라미터가 존재할 경우에만
                if ($isAllParam) {
                    $result[Constant::USER_INDEX] = $protocolInstance->handle($params);
                }
                break;
            case Protocol::REQ_GET_USER_INFO: // 유저 정보 조회
                $paramNames = [Constant::USER_ID];

                $isAllParam = $this->getParam($params, $requestData, $paramNames);

                // 모든 파라미터가 존재할 경우에만
                if ($isAllParam) {
                    $result = array_merge($result, $protocolInstance->handle($params));
                }
                break;
            case Protocol::REQ_UPDATE_USER_INFO: // 유저 정보 업데이트
                $paramNames = [Constant::USER_ID, Constant::NICKNAME];

                $isAllParam = $this->getParam($params, $requestData, $paramNames);

                // 모든 파라미터가 존재할 경우에만
                if($isAllParam){
                    $result = array_merge($result, $protocolInstance->handle($params));
                }

                break;
            default: // 지원하지 않는 프로토콜
                $handleResult = [];
                $result[Constant::PROTOCOL] = "";
                $result[Constant::ERRNO] = Errno::ERROR_PROTOCOL_INVALID;
        }

        // 정상적으로처리 됬을 시에만 프로토콜 및 타임스탬프 값 추가
        if (!is_null($result)) {
            $result[Constant::TIMESTAMP] = $params[Constant::TIMESTAMP];
            $result[Constant::PROTOCOL] = Protocol::PROTO_MAPPING[Protocol::PROTO_MAPPING[$protocol] + Protocol::GAP];
        } else {
            $result[Constant::PROTOCOL] = "";
            $result[Constant::ERRNO] = Errno::ERROR_PARAM_INVALID;
        }


        return $result;
    }

    // 요청 데이터에서 파라미터 값 가져오기
    private function getParam(&$params, $reqData, $paramNames)
    {
        foreach($paramNames as $name){
            if (isset($reqData[$name]) === true) {
                $params[$name] = $reqData[$name];
            } else {
                return false;
            }
        }

        return true;
    }

    // 프로토콜 객체 설정
    private function getProtocol($protocol)
    {
        $protocolName = "Protocol_" . $protocol;

        if (class_exists($protocolName) === false) {
            return false;
        }

        $protocolInstance = new $protocolName();

        return $protocolInstance;
    }
}