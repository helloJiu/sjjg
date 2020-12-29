<?php
/**
 * Created by helloJiu.
 * Idea: 认真编码 快乐生活
 * Date: 2020/12/29
 * Time: 21:03
 */

namespace App\Graph;


class Vertex
{
    public $value;

    public $in_edges = [];

    public $out_edges = [];

    public function __construct($value)
    {
        $this->value = $value;
    }

    public function __toString(){
        return strval($this->value);
    }
}