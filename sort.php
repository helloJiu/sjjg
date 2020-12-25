<?php
/**
 * User: helloJiu
 * Date: 2020/12/8
 * Time: 9:54
 */

use app\Sort\SortMain;
use app\Util\RandUtil;

require "vendor/autoload.php";

$arr = RandUtil::generatePersons(10000, 1000000);
$comparor = function ($e1, $e2){
    return $e1->id > $e2->id;
};

SortMain::testQuick($arr, $comparor);





