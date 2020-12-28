<?php
/**
 * User: helloJiu
 * Date: 2020/12/28
 * Time: 14:21
 */

namespace App\Tree;


class BinarySearchTree extends BinaryTree
{
    public function add($e){
        $this->checkElement($e);
        if($this->root == null){
            $this->root = new Node($e, null);
            $this->size++;
            return;
        }

        $node = $this->root;
        $parent = $node;
        // 从根节点一直向下找
        $ret = 0;
        while ($node != null){
            $parent = $node;
            $ret = $node->compare($e);
            if($ret > 0){
                $node = $node->left;
            }elseif($ret < 0){
                $node = $node->right;
            }else{
                return;
            }
        }
        $node = new Node($e, $parent);
        if($ret > 0){
            $parent->left = $node;
        }else{
            $parent->right = $node;
        }
        $this->size++;
    }
}