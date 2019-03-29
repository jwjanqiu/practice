<?php
/**
 * Created by PhpStorm.
 * User: PC-Qiu
 * Date: 2019/3/29
 * Time: 19:11
 */

/**
 * 公共返回方法
 * @param int $code
 * @param string $msg
 * @param array $data
 * @param array $headers
 * @return \Illuminate\Http\JsonResponse
 * @author Qiu
 */
function responseApi($code = 1, $msg = '请求成功', $data = array(), $headers = array())
{
    $data = array(
        'code' => $code,
        'msg' => $msg,
        'data' => (empty($data) || (!$data)) ? NULL : $data
    );
    return response()->json($data, 200, $headers);
}

/**
 * 错误状态返回
 * @param int $code
 * @param string $msg
 * @param array $data
 * @param array $headers
 * @return \Illuminate\Http\JsonResponse
 * @author Qiu
 */
function responseHttpStatus($code = 200, $msg = '请求成功', $data = array(), $headers = array())
{
    $data = array(
        'code' => $code,
        'msg' => $msg,
        'data' => (empty($data) || (!$data)) ? NULL : $data
    );
    if (isset($GLOBALS['version']) && $GLOBALS['version'] >= '1.3.0') {
        //私钥加密
        $rsaObj = new Rsa();
        $server_encrypt_private = File::get('../rsakey/server_encrypt_private.key');
        $data_resp = $rsaObj->rsaEncrypt(json_encode($data), $server_encrypt_private);
        return response()->json(['data' => $data_resp], $code, $headers);
    } else {
        return response()->json($data, $code, $headers);
    }
}
