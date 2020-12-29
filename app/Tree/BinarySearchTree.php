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

    public function contains($e){
        return $this->node($e) != null;
    }

    private function node($e){
        $this->checkElement($e);
        $node = $this->root;
        while ($node != null){
            $ret = $node->compare($e);
            if($ret > 0){
                $node = $node->left;
            }elseif($ret < 0){
                $node = $node->right;
            }else{
                return $node;
            }
        }
        return $node;
    }

    public function backendNode($e){
        $node = $this->node($e);
        if(!$node){
            throw new NotFoundException();
        }
        if($node->right){
            // 如果节点存在右子树, 则后驱节点肯定在右子树上
            $back_node = $node->right;
            while ($back_node->left != null){
                $back_node = $back_node->left;
            }
            return $back_node;
        }
        // $node = $node->parent;
        // while($node->parent != null && $node->parent->left == )


    }
}