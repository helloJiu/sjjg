<?php
/**
 * User: helloJiu
 * Date: 2020/12/28
 * Time: 13:53
 */

namespace App\Tree;


use App\Entry\Comparator;

class Node
{
    /**
     * @var Node
     */
    public $left = null;
    /**
     * @var Node
     */
    public $right = null;
    /**
     * @var Node
     */
    public $parent = null;
    public $e;

    public function __construct($e, $parent)
    {
        $this->e = $e;
        $this->parent = $parent;
    }

    public function isLeaf()
    {
        return $this->left == null && $this->right == null;
    }

    public function compare($e2)
    {
        if ($this->e instanceof Comparator) {
            return call_user_func([$this->e, 'compare'], $e2);
        }

        return $this->e - $e2;
    }
}