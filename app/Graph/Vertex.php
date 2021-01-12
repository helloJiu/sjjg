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

    /**
     * @var Edge[]
     */
    public $in_edges = [];

    /**
     * @var Edge[]
     */
    public $out_edges = [];

    public function __construct($value)
    {
        $this->value = $value;
    }

    public function __toString(){
        return strval($this->value);
    }

    public function isSame($vertex){
        return strval($vertex) == strval($this);
    }
}