<?php
/**
 * User: helloJiu
 * Date: 2020/12/25
 * Time: 17:29
 */

namespace App\Util;


class TimeUtil
{
    public static function testFunc($class, $function, ...$args){
        $start_time = microtime(true);
        call_user_func([$class, $function], ...$args);
        $end_time = microtime(true);
        $second = round($end_time - $start_time, 2);
        $m_second = round(($end_time - $start_time)*1000, 2);

        $class_name = get_class($class);

        echo "-----------$class_name->$function spent time: $second(s)----$m_second(ms)----------" . PHP_EOL;
    }
}