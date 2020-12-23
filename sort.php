<?php
/**
 * User: helloJiu
 * Date: 2020/12/8
 * Time: 9:54
 */

use app\Sort\QuickSort;
use app\Util\RandUtil;

require "vendor/autoload.php";

$arr = RandUtil::randInt(100, 10000);

$quick = new QuickSort($arr);
$quick->sort();
print_r($quick->getArr());



