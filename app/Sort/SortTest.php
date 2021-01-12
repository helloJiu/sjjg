<?php
/**
 * User: helloJiu
 * Date: 2020/12/8
 * Time: 9:54
 */

use App\Sort\HeapSort;
use App\Sort\InsertSort;
use App\Sort\QuickSort;
use App\Sort\SelectSort;
use App\Sort\ShellSort;
use App\Sort\Sort;
use App\Util\RandUtil;
use App\Util\TimeUtil;

require "../../vendor/autoload.php";

class SortTest
{
    public static function testSort()
    {
        $arr = RandUtil::generatePersons(100, 1000);
        // $arr = RandUtil::getIntegers(5000, 1000000);

        $ex_sort = new QuickSort($arr);
        $ex_sort->sort();

        $sorts = [];
        $sorts[] = new QuickSort($arr);
        $sorts[] = new SelectSort($arr);
        $sorts[] = new InsertSort($arr);
        $sorts[] = new ShellSort($arr);
        $sorts[] = new HeapSort($arr);


        $old_sort = $sorts[0];
        /** @var Sort $sort */
        foreach ($sorts as $sort) {
            TimeUtil::testFunc($sort, 'sort');
            // 测试各排序后数组是否相等, 相等表示排序正确
            var_dump($old_sort->getData() == $sort->getData());
            $old_sort = $sort;
            print_r($sort->getData());
        }
    }
}

SortTest::testSort();






