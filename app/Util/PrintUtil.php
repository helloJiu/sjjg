<?php
/**
 * Created by helloJiu.
 * Idea: 认真编码 快乐生活
 * Date: 2020/12/29
 * Time: 22:10
 */

namespace App\Util;


class PrintUtil
{
    public static function println($data){
        if(is_string($data) || is_numeric($data)){
            echo $data . PHP_EOL;
        }elseif(is_array($data)){
            foreach ($data as &$item){
                echo "[array] start___" . PHP_EOL;
                echo strval($item) . PHP_EOL;
                echo "[array] end___" . PHP_EOL;
            }
        }else{
            var_dump($data);
        }
    }
}