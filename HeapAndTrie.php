<?php
/**
 * User: helloJiu
 * Date: 2020/12/8
 * Time: 9:54
 */

require "vendor/autoload.php";


use app\Heap\BinaryHeap;
use app\Tree\Trie;


function testBinaryHeap(){
    // $elements = randInt(16);
    $elements = [1,2,3,4,5, 6,6,5,7];
    $compare = function ($e1, $e2){
        return $e1<$e2;
    };

    $heap = new BinaryHeap([], $compare);
    $heap->heapify($elements);
    $heap->replace(1001);
    $heap->add(1005);
    var_dump($heap->height());
    $heap->print();
    $size = $heap->size();
    for($i=0; $i<$size; $i++){
        // echo 'Heap element is: '. $heap->get() . PHP_EOL;
        // $heap->print();
    }
}

function randInt($count, $max=1000){
    $elements = [];
    for($i=0; $i<$count; $i++){
        $elements[] = mt_rand(0,$max);
    }
    return $elements;
}

function top5(){
    echo "初始: ".memory_get_usage()." 字节 \n";
    $data = randInt(2000000, 100000000);
    print_r(count($data));
    echo "最终: ".memory_get_usage()/1024/1024 . " M \n";
    // unset($data);
    // echo "最终: ".memory_get_usage()/1024/1024 . " M \n";
    $heap = new BinaryHeap();
    foreach($data as $index => $v){
        if($index < 5){
            $heap->add($v);
        }else{
            $top_el = $heap->getTopElement();
            if($v < $top_el){
                $heap->replace($v);
            }
        }
    }
    $heap->print();
}

function testTrie(){
    $trie = new Trie();
    $trie->add('a', 'aaa-----------');
    $trie->add('aB', 1);
    $trie->add('aC', 2);
    $trie->add('aCD', 3);
    $trie->add('TOm', 4);
    $trie->add('中国ab1', 4);

    //var_dump($trie);
    var_dump($trie->get('aCD'));
    var_dump($trie->get('T'));
    var_dump($trie->get('中国ab1'));
    var_dump($trie->prefixExist('中国1'));

}

// testBinaryHeap();
//top5();
testTrie();
