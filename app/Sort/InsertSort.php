<?php
/**
 * User: helloJiu
 * Date: 2020/12/25
 * Time: 17:55
 */

namespace App\Sort;


class InsertSort extends Sort
{
    public function sort()
    {
        // 插入排序, 类比扑克牌
        for ($i = 1; $i < count($this->data); $i++) {
            $v = $this->data[$i];
            $j = $i;
            while ($j>0 && $this->compare($this->data[$j-1], $v) > 0){
                $this->data[$j] = $this->data[$j-1];
                $j--;
            }
            if($j != $i){
                $this->data[$j] = $v;
            }
        }
    }
}