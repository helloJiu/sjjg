<?php
/**
 * Created by helloJiu.
 * Idea: 认真编码 快乐生活
 * Date: 2020/12/25
 * Time: 21:52
 */

namespace App\Sort;


class ShellSort extends Sort
{
    public function sort()
    {
        // 核心原理: 多次大步长交换元素, 大幅度减少逆序对
        // 增加了步长的插入排序
        /*
         * 初始待排序数据
            11 21 43 23 43
            98 16 32 19 22
            55
           数据:
            step = [5, 2, 1]
            1. step = 5
                1) 11 98 55 进行插入排序
                2) 21 16 进行插入排序
                3) 43 32 进行插入排序
                4) 23 19 进行插入排序
                5) 43 22 进行插入排序
            2. step = 2
                待排序数据
                    xx1 xx2
                    xx3 xx4
                    xx5 xx6
                    xx7 xx8
                    xx9 xx10
                    xx11
                 1) xx1, xx3, xx5, xx7, xx9, xx11进行插入排序
                 2) xx2, xx4, xx6, xx8, xx10 进行出入排序
            3. step = 1时,
                xx1 - xx11 一次性进行插入排序, 和常规插入排序等同

         */

        // 构造步长
        $steps = $this->getSteps();
        foreach ($steps as $step) {
            // 当step=1时, 就是普通的插入排序
            for ($k = 0; $k < $step; $k++) {
                // 每次跨越step个步长进行插入排序
                for ($i = $k + $step; $i < count($this->data); $i = $i + $step) {
                    $v = $this->data[$i];
                    $j = $i;
                    //echo "$i"."_$j"."_$step"."_$k" . PHP_EOL;
                    // $j 大于 插入排序开始时第一个元素索引
                    while ($j > $k && $this->compare($this->data[$j - $step], $v)) {
                        //echo "  ". "$i"."_$j"."_$step"."_$k" . PHP_EOL;
                        $this->data[$j] = $this->data[$j - $step];
                        $j = $j - $step;
                    }
                    if ($j != $i) {
                        $this->data[$j] = $v;
                    }
                }
            }

        }
    }

    /**
     * 获取步长
     * @return array
     */
    private function getSteps()
    {
        $steps = [];
        $step = count($this->data);
        while (($step = $step >> 1) > 0) {
            //echo $step;
            $steps[] = $step;
        }
        //print_r($steps);
        return $steps;
    }
}