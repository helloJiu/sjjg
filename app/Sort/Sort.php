<?php
/**
 * User: helloJiu
 * Date: 2020/12/25
 * Time: 17:10
 */

namespace App\Sort;


use App\Entry\Comparator;

class Sort
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function sort()
    {

    }

    protected function compare($e1, $e2)
    {
        if ($e1 instanceof Comparator) {
            return call_user_func([$e1, 'compare'], $e2);
        }

        return $e1 - $e2;
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