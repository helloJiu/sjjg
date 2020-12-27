<?php
/**
 * Created by helloJiu.
 * Idea: 认真编码 快乐生活
 * Date: 2020/12/27
 * Time: 17:31
 */

namespace App\UnionFind;

use App\Util\RandUtil;
use App\Util\TimeUtil;

require "../../vendor/autoload.php";

class UnionTest
{
    public static function testUnion()
    {
        //$uf = new UnionFindQF(12);
        //$uf = new UnionFindQU(12);
        //$uf = new UnionFindQUSize(12);
        $uf = new UnionFindQUHeight(12);
        $uf->union(1, 2);
        $uf->union(2, 4);
        $uf->union(6, 2);
        $uf->union(8, 9);
        $uf->union(10, 11);
        $uf->union(1, 8);
        //$uf->union(1,10);
        $uf->union(3, 1);

        var_dump($uf->isSame(1, 6));
        var_dump($uf->isSame(8, 10));
        var_dump($uf->isSame(1, 9));
        print_r($uf->getData());
        print_r($uf->getHeight());
    }

    public function randUfSizeTest(AbsUnionFind $uf, $length)
    {
        for ($i = 0; $i < $length; $i++) {
            $uf->union(random_int(1, $length-1), random_int(1, $length-1));
        }
    }
}

//UnionTest::testUnion();

$length = 2000000;
$ufs = [
    //new UnionFindQF($length),
    //new UnionFindQU($length),
    new UnionFindQUSize($length),
    new UnionFindQUHeight($length)
];

foreach ($ufs as $uf){
    $test = new UnionTest();
    echo get_class($uf) . PHP_EOL;
    TimeUtil::testFunc($test,'randUfSizeTest', $uf, $length);
}

/*
 * $length=10000
App\UnionFind\UnionFindQF
-----------App\UnionFind\UnionTest->randUfSizeTest spent time: 6.83(s)----6833.39(ms)----------
App\UnionFind\UnionFindQU
-----------App\UnionFind\UnionTest->randUfSizeTest spent time: 0.13(s)----131.28(ms)----------
App\UnionFind\UnionFindQUSize
-----------App\UnionFind\UnionTest->randUfSizeTest spent time: 0.01(s)----10.67(ms)----------
App\UnionFind\UnionFindQUHeight
-----------App\UnionFind\UnionTest->randUfSizeTest spent time: 0.01(s)----9.83(ms)----------

$length = 2000000;
App\UnionFind\UnionFindQUSize
-----------App\UnionFind\UnionTest->randUfSizeTest spent time: 2.83(s)----2826.25(ms)----------
App\UnionFind\UnionFindQUHeight
-----------App\UnionFind\UnionTest->randUfSizeTest spent time: 2.92(s)----2918.34(ms)----------
 */

