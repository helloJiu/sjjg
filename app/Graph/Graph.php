<?php
/**
 * Created by helloJiu.
 * Idea: 认真编码 快乐生活
 * Date: 2020/12/29
 * Time: 21:01
 */

namespace App\Graph;


use App\Tree\NotFoundException;
use App\Util\PrintUtil;

class Graph
{
    /**
     * 遍历时存储已经遍历的节点
     * @var array
     */
    private $set = [];

    public function __construct()
    {
    }

    /**
     * @var Vertex[]
     */
    private array $vertices = [];

    /**
     * @var Edge[]
     */
    private array $edges = [];

    public function print()
    {
        echo "顶点:----------" . PHP_EOL;
        foreach ($this->vertices as &$vertex) {
            PrintUtil::println($vertex->value);
            PrintUtil::println("out-----------" . count($vertex->out_edges));
            PrintUtil::println("in-----------" . count($vertex->in_edges));
        }

        echo "边:----------" . PHP_EOL;
        foreach ($this->edges as &$edge) {
            var_dump($edge->getString());
        }

    }

    public function addVertex($v)
    {
        if (isset($this->vertices[strval($v)])) {
            return;
        }
        $this->vertices[strval($v)] = new Vertex($v);
    }

    /**
     * @param $from_v
     * @param $to_v
     * @param int $weight
     */
    public function addEdge($from_v, $to_v, $weight = 0)
    {
        $str_from_v = strval($from_v);
        if (empty($this->vertices[$str_from_v])) {
            $this->vertices[$str_from_v] = new Vertex($from_v);
        }
        $from_vertex = $this->vertices[$str_from_v];

        $str_to_v = strval($to_v);
        if (empty($this->vertices[$str_to_v])) {
            $this->vertices[$str_to_v] = new Vertex($to_v);
        }
        $to_vertex = $this->vertices[$str_to_v];

        $edge = new Edge($from_vertex, $to_vertex);
        $edge->weight = $weight;

        $str_edge = strval($edge);
        $from_vertex->out_edges[$str_edge] = $edge;
        $to_vertex->in_edges[$str_edge] = $edge;
        $this->edges[$str_edge] = $edge;

    }

    /**
     * @return Vertex[]
     */
    public function getVertices(): array
    {
        return $this->vertices;
    }

    /**
     * @return Edge[]
     */
    public function getEdges(): array
    {
        return $this->edges;
    }

    // 广度遍历
    public function bfs($v)
    {
        $vertex = $this->getVertex($v);
        $queue = new \SplQueue();
        $queue->enqueue($vertex);
        $this->set[strval($vertex)] = true;
        while (!$queue->isEmpty()) {
            /** @var Vertex $vertex */
            $vertex = $queue->dequeue();
            PrintUtil::println(strval($vertex));
            /** @var Edge $edge */
            foreach ($vertex->out_edges as $edge) {
                $to_vertex = $edge->to;
                if (!isset($this->set[strval($to_vertex)])) {
                    $queue->enqueue($to_vertex);
                    $this->set[strval($to_vertex)] = true;
                }
            }
        }
    }

    /**
     * 递归实现深度优先
     * @param $v
     * @param $callback
     */
    public function dfsByRecusion($v, &$callback)
    {
        $vertex = $this->getVertex($v);
        $this->dfsByRecusionInner($vertex, $callback);
    }

    private function dfsByRecusionInner(Vertex $vertex, &$callback)
    {
        $callback($vertex->value);
        $this->set[strval($vertex)] = true;
        foreach ($vertex->out_edges as $edge) {
            if (!isset($this->set[strval($edge->to)])) {
                $this->dfsByRecusionInner($edge->to, $callback);
            }
        }
    }

    /**
     * 循环实现深度优先
     * @param $v
     * @param $callback
     * @throws NotFoundException
     */
    public function dfsByLoop($v, &$callback)
    {
        $vertex = $this->getVertex($v);
        $stack = new \SplStack();
        $stack->push($vertex);
        $callback($vertex->value);
        $this->set[strval($vertex)] = true;

        while (!$stack->isEmpty()) {
            /** @var Vertex $vertex */
            $vertex = $stack->pop();
            // 一个节点有多条边的时候会多次压栈和弹栈, 发生多次如下遍历代码
            foreach ($vertex->out_edges as $edge) {
                if (isset($this->set[strval($edge->to)])) continue;
                // 利用栈模拟函数调用
                // 每次都将遍历起点和终点入栈
                $callback($edge->to->value);
                $this->set[strval($edge->to)] = true;
                $stack->push($vertex);
                $stack->push($edge->to);

            }
        }
    }

    /**
     * @param $v
     * @return Vertex
     * @throws NotFoundException
     */
    private function getVertex($v)
    {
        $vertex = $this->vertices[strval($v)] ?? null;
        $this->checkVertex($vertex);
        $this->set = [];
        return $vertex;
    }

    private function checkVertex($vertex)
    {
        if (is_null($vertex)) {
            throw new NotFoundException();
        }
    }


}