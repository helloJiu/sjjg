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
 * union时, 直接将元素父节点改成要合并的元素的父节点
 * Class UnionFindQF
 * @package App\UnionFind
 */
class UnionFindQU extends AbsUnionFind
{
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

        $this->data[$p1] = $p2;
    }
}