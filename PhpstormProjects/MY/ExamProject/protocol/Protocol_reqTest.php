<?php
/**
 * Created by PhpStorm.
 * User: 이창선
 * Date: 2018-01-18
 * Time: 오후 7:54
 */

class Protocol_reqTest implements ProtocolInterface
{
    // Test
    public function handle($params)
    {
        $tmp = $params[Constant::INPUT_DATA];
        $result = $tmp[Constant::INPUT_NUMBER] * ($params[Constant::TIMESTAMP] % 10);

        $params[Constant::OUTPUT_NUMBER] = $result;

        return $params;
    }
}