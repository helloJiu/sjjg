<?php
/**
 * User: helloJiu
 * Date: 2020/12/7
 * Time: 16:22
 */

namespace App\Heap;

use SplQueue;

class BinaryHeap implements Heap
{

    private $size = 0;

    const Default_Cap = 10;
    /**
     * @var array
     */
    private $elements = [];
    /**
     * @var function
     */
    private $comparator = null;

    public function __construct($elements = [], $comparator = null)
    {
        $this->comparator = $comparator;

        if ($elements) {
            $this->heapify($elements);
        }
    }

    public function isEmpty()
    {
        return $this->size == 0;
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
        $this->up($this->size - 1);
    }


    private function up($index)
    {
        $element = $this->elements[$index];
        while ($index > 0) {
            $p_index = $this->getPIndex($index);
            if ($this->compare($element, $this->elements[$p_index])) {
                break;
            }
            $p_el = $this->elements[$p_index];
            $this->elements[$p_index] = $element;
            $this->elements[$index] = $p_el;
            $index = $p_index;
        }
    }

    public function getElements()
    {
        return $this->elements;
    }

    public function get()
    {
        if ($this->isEmpty()) {
            throw new OutOfBoundsException("Heap is empty");
        }
        $element = $this->elements[0];
        $this->elements[0] = $this->elements[$this->size - 1];
        $this->size--;
        $this->down(0);
        return $element;
    }

    private function down($index)
    {
        $element = $this->elements[$index];
        $min_leaf_index = pow(2, $this->height() - 1) - 1;
        while ($index < $min_leaf_index) {
            $left_index = $this->getLeftIndex($index);
            $right_index = $this->getRightIndex($index);
            if ($left_index >= $this->size) {
                break;
            }

            $max = $this->elements[$left_index];
            $max_index = $left_index;

            if ($right_index < $this->size) {
                $right = $this->elements[$right_index];
                if($this->compare($max, $right)){
                    $max = $right;
                    $max_index = $right_index;
                }

            }

            if ($this->compare($max, $element)) {
                break;
            }
            // 下移
            $this->elements[$index] = $max;
            $this->elements[$max_index] = $element;
            $index = $max_index;
        }
    }


    public function replace($element)
    {
        $ret_el = $this->get();
        $this->add($element);
        return $ret_el;
    }

    public function heapify($elements)
    {
        foreach ($elements as $element) {
            $this->add($element);
        }
    }

    public function print()
    {
        $data = [];
        $queue = new SplQueue();
        $queue->enqueue(0);
        $count = 0;
        $height = 1;
        while (!$queue->isEmpty()) {
            $index = $queue->dequeue();
            $left = $this->getLeftIndex($index);
            $right = $this->getRightIndex($index);
            if ($left < $this->size) {
                $count++;
                $queue->enqueue($left);
            }
            if ($right < $this->size) {
                $count++;
                $queue->enqueue($right);
            }

            $data[$height][] = $this->elements[$index];
            if ($queue->count() == $count) {
                $count = 0;
                // 到一层末尾
                $height++;
            }

        }

        $sep = ' ';

        $total_height = $this->height();
        $width = pow(2, $total_height);
        $ret = [];
        foreach ($data as $height => $row) {
            $str = '';
            foreach ($row as $v) {
                $sep_width = str_repeat($sep, $width);
                $str .= $sep_width . $v . $sep_width;
            }
            $ret[] = $str;
            $width = $width / 2;
        }


        foreach ($ret as $str) {
            echo $str . PHP_EOL;
        }

    }

    public function height()
    {
        $height = 0;
        $index = $this->size - 1;
        while ($index >= 0) {
            $height++;
            $index = $this->getPIndex($index);
        }
        return $height;
    }

    private function getPIndex($index)
    {
        return ($index + 1) / 2 - 1;
    }

    private function getLeftIndex($index)
    {
        return $index * 2 + 1;
    }

    private function getRightIndex($index)
    {
        return $index * 2 + 2;
    }

    private function compare($e1, $e2){
        if(!$this->comparator){
            return $e1 > $e2;
        }

        return call_user_func($this->comparator, $e1, $e2);
    }

    public function getTopElement(){
        if($this->isEmpty()){
            throw new OutOfBoundsException();
        }
        return $this->elements[0];
    }
}