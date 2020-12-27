<?php
/**
 * Created by helloJiu.
 * Idea: 认真编码 快乐生活
 * Date: 2020/12/27
 * Time: 10:44
 */

namespace App\UnionFind;

/**
 * 并查集
 * find 和 union 使用多层树结构
 * find时, 查找父节点一直到 元素的父节点就是元素本身
 * union时, 直接将元素父节点改成要合并的元素的父节点, 高度矮的合并到高度高的
 * Class UnionFindQF
 * @package App\UnionFind
 */
class UnionFindQUHeight extends AbsUnionFind
{
    private $height = [];

    public function __construct($length)
    {
        parent::__construct($length);
        for($i = 0; $i< $length; $i++){
            // 初始时, 每个元素只有自己一个
            $this->height[$i] = 1;
        }
    }

    public function find($v)
    {
        $this->checkOutOfBound($v);
        while ($this->data[$v] != $v){
            // 一直向上找
            $v = $this->data[$v];
        }
        return $v;
    }

    /**
     * 将v1合并到v2上
     * @param $v1
     * @param $v2
     */
    public function union($v1, $v2)
    {
        $p1 = $this->find($v1);
        $p2 = $this->find($v2);

        if ($p1 == $p2) {
            return;
        }

        // 高度矮的合并到高度高的
        if($this->height[$p1] > $this->height[$p2]){
            //$p2合并到$p1上
            $this->data[$p2] = $p1;
        }elseif($this->height[$p1] < $this->height[$p2]){
            // p1 合并到p2上
            $this->data[$p1] = $p2;
        }else{
            // p1->p2 | p2->p1 都可以
            // 此处将p1合并到p2上, p2高度增加1
            $this->data[$p1] = $p2;
            $this->height[$p2]++;
        }
    }

    public function getHeight(){
        return $this->height;
    }
}