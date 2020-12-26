<?php
/**
 * User: helloJiu
 * Date: 2020/12/25
 * Time: 17:10
 */

namespace App\Sort;


class Sort
{
    protected $comparator;

    protected $data;

    public function __construct($data, $comparator = null)
    {
        $this->data = $data;
        $this->comparator = $comparator;
    }

    public function sort()
    {

    }

    protected function compare($e1, $e2)
    {
        if (!$this->comparator) {
            return $e1 > $e2;
        }

        return call_user_func($this->comparator, $e1, $e2);
    }

    public function getData()
    {
        return $this->data;
    }

    protected function swap($i1, $i2)
    {
        $tmp = $this->data[$i1];
        $this->data[$i1] = $this->data[$i2];
        $this->data[$i2] = $tmp;
    }

}