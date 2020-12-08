<?php
/**
 * User: helloJiu
 * Date: 2020/12/7
 * Time: 16:22
 */

interface Heap
{
    public function size();

    public function clear();

    public function add($element);

    public function get();

    public function replace($element);

    public function isEmpty();


}