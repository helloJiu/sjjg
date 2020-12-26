<?php
/**
 * Created by helloJiu.
 * Idea: 认真编码 快乐生活
 * Date: 2020/12/26
 * Time: 10:45
 */

namespace App\Sort;


use App\Heap\BinaryHeap;

class HeapSort extends Sort
{
    private $heap;

    public function __construct($data, $comparator = null)
    {
        parent::__construct([], $comparator);
        $this->heap = new BinaryHeap($data, $comparator);
        //$this->heap->print();
    }

    public function Sort()
    {
        $size = $this->heap->size();
        for ($i = 0; $i < $size; $i++) {
            //echo 'size: '. $this->heap->size() . PHP_EOL;
            $this->data[$i] = $this->heap->get();
        }
    }

}