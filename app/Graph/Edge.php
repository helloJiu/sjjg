<?php
/**
 * Created by helloJiu.
 * Idea: 认真编码 快乐生活
 * Date: 2020/12/29
 * Time: 21:07
 */

namespace App\Graph;


class Edge
{
    /**
     * @var Vertex
     */
    public $from;

    /**
     * @var Vertex
     */
    public $to;

    public $weight;

    public function __construct(Vertex $from, Vertex $to)
    {
        $this->from = $from;
        $this->to = $to;
    }

    public function getString()
    {
       return "Edge[from={$this->from}, to={$this->to}, weight={$this->weight}]";
    }

    public function __toString()
    {
        return "{$this->from}___{$this->to}";
    }
}