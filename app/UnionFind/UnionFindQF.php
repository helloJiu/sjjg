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
 * quick find
 * 合并o(n)
 * Class UnionFindQF
 * @package App\UnionFind
 */
class UnionFindQF extends AbsUnionFind
{
    public function find($v)
    {
        $this->checkOutOfBound($v);
        return $this->data[$v];
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

        for ($i = 0; $i < count($this->data); $i++) {
            // 将父节点是p1的元素都设置成p2
            if($this->data[$i] == $p1){
                $this->data[$i] = $p2;
            }
        }
    }
}