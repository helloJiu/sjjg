<?php

/**
 * Created by helloJiu.
 * Idea: 认真编码 快乐生活
 * Date: 2020/12/12
 * Time: 13:13
 */
namespace app\Tree;

class Trie
{
    private $root;

    private $size;

    public function __construct()
    {
        $this->size = 0;
        $this->root = new TrieNode();
    }

    public function size(){
        return $this->size;
    }

    public function add(string $k, $v){
        $node = $this->root;
        $c_node = null;
        $len = mb_strlen($k);
        for($i=0; $i<$len; $i++){
            $c_node = $node->childs[$k[$i]] ?? null;
            if($c_node == null){
                $c_node = new TrieNode();
                if($len == $i+1){
                    $c_node->is_end = true;
                    $c_node->v = $v;
                    $this->size++;
                }
                $node->childs[$k[$i]] = $c_node;
            }
            $node = $c_node;
        }
    }


    public function get($k){
        $node = $this->getNode($k);
        if($node != null && $node->is_end){
            return $node->v;
        }
        return null;

    }

    public function contain($k){
        $node = $this->get($k);
        return $node === null ? false : true;
    }

    public function prefixExist($prefix){
        $node = $this->getNode($prefix);
        return $node === null ? false : true;
    }


    public function getNode($k){
        $node = $this->root;
        $c_node = null;
        $len = mb_strlen($k);

        for($i=0; $i<$len; $i++){
            $c_node = $node->childs[$k[$i]] ?? null;
            $node = $c_node;
            if($c_node == null){
                break;
            }
        }
        return $node;
    }



    public function print(){
        $this->printNode($this->root);
    }

    private function printNode(TrieNode $node)
    {
        if($node == null){
            return;
        }
        foreach($node->childs as $k => $node){
            echo $k;
            if($node->is_end){
                echo " v={$node->v}";
            }
            echo PHP_EOL;
            $this->printNode($node);
        }
    }

    public function root(){
        return $this->root;
    }

}

class TrieNode{
    public $childs = [];
    public $is_end = false;
    public $v;
}