<?php
/**
 * Created by helloJiu.
 * Idea: 认真编码 快乐生活
 * Date: 2020/12/27
 * Time: 10:35
 */

namespace App\UnionFind;

/**
 * 数组实现并查集
 * Class AbsUnionFind
 * @package App\UnionFind
 */
class AbsUnionFind
{
    /**
     * 索引存元素, 值存元素的父节点
     * @var array
     */
    protected $data;

    public function __construct($length)
    {
        $this->data = [];
        for ($i = 0; $i < $length; $i++) {
            $this->data[$i] = $i;
        }
    }

    /**
     * 查找顶级节点
     * @param $v
     */
    public function find($v)
    {
    }

    /**
     * 合并节点
     * @param $v1
     * @param $v2
     */
    public function union($v1, $v2)
    {
    }

    protected function checkOutOfBound($v){
        if(empty($this->data[$v])){
            throw new \OutOfBoundsException('下标越界');
        }
    }

    public function isSame($v1, $v2){
        return $this->find($v1) == $this->find($v2);
    }

    public function getData(){
        return $this->data;
    }


}