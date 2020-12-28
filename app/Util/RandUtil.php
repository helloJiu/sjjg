<?php

namespace App\Util;

use App\Entry\Person;

/**
 * Created by helloJiu.
 * Idea: 认真编码 快乐生活
 * Date: 2020/12/23
 * Time: 21:57
 */
class RandUtil
{
    public static function getIntegers($count, $max=1000){
        $elements = [];
        for($i=0; $i<$count; $i++){
            $elements[] = mt_rand(0,$max);
        }
        return $elements;
    }

    public static function getRandChar($length)
    {
        $str    = null;
        $strPol = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz";
        $max    = strlen($strPol) - 1;

        for ($i = 0; $i < 32; $i++) {
            $str .= $strPol[rand(0, $max)];
        }

        return substr(md5($str), 0, $length);
    }

    public static function generatePersons($count, $max){
        $persons = [];
        $ids = self::getIntegers($count, $max);
        foreach($ids as $id){
            $persons[] = new Person($id, self::getRandChar(8));
        }
        return $persons;
    }
}