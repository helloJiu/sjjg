<?php
/**
 * User: helloJiu
 * Date: 2020/12/7
 * Time: 16:22
 */

class BinaryHeap implements Heap
{

    private $size = 0;

    const Default_Cap = 10;
    /**
     * @var array
     */
    private $elements;

    public function __construct($elements)
    {
        if($elements){
            $this->heapify($elements);
        }else{
            $this->elements = [];
        }
    }

    public function size()
    {
        return $this->size;
    }

    public function clear()
    {
        $this->size = 0;
        $this->elements = [];
    }

    public function add($element)
    {
        $this->elements[$this->size++] = $element;
        // $old_index =
    }

    public function get()
    {

    }

    public function replace()
    {

    }

    private function heapify($elements)
    {

    }
}