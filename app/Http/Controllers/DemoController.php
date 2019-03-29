<?php
/**
 * Created by PhpStorm.
 * User: PC-Qiu
 * Date: 2019/3/29
 * Time: 19:14
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DemoController extends Controller
{
    /**
     * demo示例
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @author Qiu
     */
    public function demo(Request $request)
    {
        //获取所有传过来的参数
        $params = $request->input();
        //获取单个参数，例如：user_id
        $user_id = $request->input('user_id');
        //必传参数可以做判断
        if ($request->has('name')) {
            $name = $request->input('name');
        } else {
            //若无该参数，统一调用错误码返回参数
            return responseHttpStatus(400, '缺少name参数');
        }
        /**
         * 处理相关逻辑。。。
         */
        $data = array(
            'params' => $params,
            'user_id' => $user_id,
            'name' => $name
        );
        //返回数据，返回数据用统一返回方法返回
        return responseApi(1, '请求失败', $data);
    }
}
