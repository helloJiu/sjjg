<?php
/**
 * User: helloJiu
 * Date: 2020/12/28
 * Time: 13:53
 */

namespace App\Tree;


class Node
{
    public $left = null;
    public $right = null;
    public $parent = null;
    public $e;

    public function __construct($e, $parent)
    {
        $this->e = $e;
        $this->parent = $parent;
    }

    public function isLeaf(){
        return $this->left == null && $this->right == null;
    }

    public function compare($e2)
    {
        if (!is_object($this->e) || isset($this->e->comparator)) {
            return $this->e - $e2;
        }

        return call_user_func($this->e->comparator, $this->e, $e2);
    }
}