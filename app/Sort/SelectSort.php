<?php
/**
 * Created by helloJiu.
 * Idea: 认真编码 快乐生活
 * Date: 2020/12/25
 * Time: 21:29
 */

namespace App\Sort;


class SelectSort extends Sort
{
    public function sort()
    {
        for ($i = 0; $i < count($this->data); $i++) {
            $min = $i;
            for ($j = $i + 1; $j < count($this->data); $j++) {
                if($this->compare($this->data[$min], $this->data[$j]) > 0){
                    $min = $j;
                }
            }
            if($min != $i){
                $this->swap($i, $min);
            }
        }
    }
}