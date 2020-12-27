<?php

use App\Heap\BinaryHeap;

/**
 * Created by helloJiu.
 * Idea: 认真编码 快乐生活
 * Date: 2020/12/26
 * Time: 10:56
 */
require "../../vendor/autoload.php";

class HeapTest
{

    public static function testBinaryHeap($elements, $comparator = null)
    {
        $heap = new BinaryHeap($elements, $comparator);
        //$heap->replace(1001);
        //$heap->add(1005);
        var_dump($heap->height());
        $heap->print();
        $size = $heap->size();
        for ($i = 0; $i < $size; $i++) {
            echo 'Heap element is: ' . $heap->get() . PHP_EOL;
            //$heap->print();
        }
    }


    public function top5()
    {
        echo "初始: " . memory_get_usage() . " 字节 \n";
        $data = randInt(2000000, 100000000);
        print_r(count($data));
        echo "最终: " . memory_get_usage() / 1024 / 1024 . " M \n";
        // unset($data);
        // echo "最终: ".memory_get_usage()/1024/1024 . " M \n";
        $heap = new BinaryHeap();
        foreach ($data as $index => $v) {
            if ($index < 5) {
                $heap->add($v);
            } else {
                $top_el = $heap->getTopElement();
                if ($v < $top_el) {
                    $heap->replace($v);
                }
            }
        }
        $heap->print();
    }
}

//$elements = [1, 2, 3, 4, 5, 6, 6, 5, 7];
$elements = \App\Util\RandUtil::getIntegers(100, 1000);
//$comparator = function ($e1, $e2){
//    return $e1<$e2;
//};


HeapTest::testBinaryHeap($elements);