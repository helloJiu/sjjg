<?php
/**
 * User: helloJiu
 * Date: 2020/12/28
 * Time: 13:50
 */

namespace App\Tree;


use App\Tree\Printer\BinaryTreePrinterInterface;

class BinaryTree implements BinaryTreePrinterInterface
{

    /**
     * @var Node
     */
    protected $root = null;

    protected $size = 0;

    protected function checkElement($e){
        if($e == null){
            throw new \Exception("元素不能为null");
        }
    }

    /**
     * who is the root node
     */
    public function root()
    {
        return $this->root;
    }

    /**
     * how to get the left child of the node
     */
    public function left($node)
    {
        return $node->left;
    }

    /**
     * how to get the right child of the node
     */
    public function right($node)
    {
        return $node->right;
    }

    /**
     * how to print the node
     */
    public function string($node)
    {
        return strval($node->e);
    }


}