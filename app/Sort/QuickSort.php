<?php

namespace App\Sort;
/**
 * Created by helloJiu.
 * Idea: 认真编码 快乐生活
 * Date: 2020/12/23
 * Time: 21:35
 */
class QuickSort extends Sort
{

    public function sort(){
        $this->sortInner(0, count($this->data));
    }

    protected function sortInner($begin, $end){
        if($end - $begin < 2){
            return;
        }

        $mid = $this->getPivot($begin, $end);
        $this->sortInner($begin, $mid);
        $this->sortInner($mid+1, $end);
    }

    /**
     * begin 和 end 左闭右开
     * @param $begin
     * @param $end
     */
    private function getPivot($begin, $end){
        // 首先备份轴点元素
        $v = $this->data[$begin];
        $end--;

        while ($begin < $end){
            // 从后向前比
            // 元素相同时, 应该交换
            while ($begin < $end){
                if($this->compare($this->data[$end], $v)){
                    // 如果结尾位置元素大于轴点, 直接向前挪动
                    $end--;
                }else{
                    // end元素位置可以覆盖了, 所以需要从最前边比较
                    $this->data[$begin] = $this->data[$end];
                    $begin++;
                    break;
                }
            }

            // 从前向后比
            while ($begin < $end){
                if($this->compare($v, $this->data[$begin])){
                    $begin++;
                }else{
                    // 将begin的位置覆盖到$end的位置, 然后begin的位置就可以重新覆盖了
                    // 换方向从后往前比
                    $this->data[$end] = $this->data[$begin];
                    $end--;
                    break;
                }
            }

        }

        // 当begin和end重合时, 完毕
        $this->data[$begin] = $v;
        return $begin;

    }


}