<?php
/**
 * User: helloJiu
 * Date: 2020/12/25
 * Time: 18:01
 */

namespace app\Sort;

use app\Util\RandUtil;
use app\Util\TimeUtil;

class SortMain
{
    public static function testQuick($arr, $comparor){
        $quick = new QuickSort($arr);

        $quick->setComparor($comparor);

        TimeUtil::testFunc($quick, 'sort');
        // $quick->sort();

        // print_r($quick->getData());
    }
}