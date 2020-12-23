<?php

namespace app\Util;
/**
 * Created by helloJiu.
 * Idea: 认真编码 快乐生活
 * Date: 2020/12/23
 * Time: 21:57
 */
class RandUtil
{
    public static function randInt($count, $max=1000){
        $elements = [];
        for($i=0; $i<$count; $i++){
            $elements[] = mt_rand(0,$max);
        }
        return $elements;
    }
}