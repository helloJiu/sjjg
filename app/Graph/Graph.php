<?php
/**
 * Created by helloJiu.
 * Idea: 认真编码 快乐生活
 * Date: 2020/12/29
 * Time: 21:01
 */

namespace App\Graph;


use App\Exception\NotFoundException;
use App\Heap\BinaryHeap;
use App\UnionFind\UnionFindQUHeight;
use App\Util\PrintUtil;

class Graph
{
    const Inf = 9999999999999999;
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
    private $vertexes = [];

    /**
     * @var Edge[]
     */
    private $edges = [];

    public function print(){
        echo "顶点:----------" . PHP_EOL;
        foreach ($this->vertexes as &$vertex){
            PrintUtil::println($vertex->value);
            PrintUtil::println("out-----------" . count($vertex->out_edges));
            PrintUtil::println("in-----------" . count($vertex->in_edges));
        }

        echo "边:----------" . PHP_EOL;
        foreach ($this->edges as &$edge){
            var_dump($edge->getString());
        }

    }

    public function addVertex($v){
        if(isset($this->vertexes[strval($v)])){
            return;
        }
        $this->vertexes[strval($v)] = new Vertex($v);
    }

    /**
     * @param $from_v
     * @param $to_v
     * @param int $weight
     */
    public function addEdge($from_v, $to_v, $weight = 1){
        $str_from_v = strval($from_v);
        if(empty($this->vertexes[$str_from_v])){
            $this->vertexes[$str_from_v] = new Vertex($from_v);
        }
        $from_vertex = $this->vertexes[$str_from_v];

        $str_to_v = strval($to_v);
        if(empty($this->vertexes[$str_to_v])){
            $this->vertexes[$str_to_v] = new Vertex($to_v);
        }
        $to_vertex = $this->vertexes[$str_to_v];

        $edge = new Edge($from_vertex, $to_vertex);
        $edge->weight = $weight;

        $str_edge = strval($edge);
        $from_vertex->out_edges[$str_edge] = $edge;
        $to_vertex->in_edges[$str_edge] = $edge;
        $this->edges[$str_edge] = $edge;

    }

    private function vertex($v){
        return $this->vertexes[strval($v)] ?? null;
    }


    /**
     * 获取从某个节点到达其他节点的最短路径
     * @param $v
     * @return array
     * @throws NotFoundException
     */
    public function getShortPaths($v){
        $vertex = $this->vertex($v);
        if(!$vertex){
            throw new NotFoundException();
        }

        // 记录未选择的订单最短路径
        $table = [];
        // 记录最短路径值
        $short_weights  = [];
        // 记录最短路径
        $paths = [];
        // 记录节点最短路径的前一个节点
        $fronts = [];

        foreach($this->vertexes as $o_vertex){
            $table[strval($o_vertex)] = self::Inf;
        }

        foreach($vertex->out_edges as $edge){
            $table[strval($edge->to)] = $edge->weight;
            $fronts[strval($edge->to)] = strval($vertex);
        }

        while (true){
            if(empty($table)){
                break;
            }
            $min_weight = self::Inf;
            $min_v = '';
            foreach($table as $s_v => $weight){
                // 选出最小的weight
                if($min_weight > $weight){
                    $min_weight = $weight;
                    $min_v = $s_v;
                }
            }
            if($min_weight == self::Inf){
                break;
            }

            // 选出权值最小的记录, 并查看该记录顶点的出度,
            // 尝试更新table各节点最短路径
            // 记录该节点的路径节点
            unset($table[$min_v]);
            $path = $paths[$fronts[$min_v]] ?? [];
            $path[] = $min_v;
            $paths[$min_v] = $path;

            $short_weights[$min_v] = $min_weight;

            $c_vertex = $this->vertexes[$min_v];
            foreach ($c_vertex->out_edges as $edge){
                $to_v = strval($edge->to);
                if($edge->to->isSame($vertex)){
                    continue;
                }

                if(isset($short_weights[$to_v])){
                    continue;
                }

                if(isset($table[$to_v]) && $min_weight + $edge->weight >= $table[$to_v]){
                    continue;
                }
                // 更新table表中到各自节点的最小权值
                $table[$to_v] = $min_weight + $edge->weight;
                $fronts[$to_v] = strval($c_vertex);
            }
        }

        return compact('short_weights', 'paths');

    }


    public function mst(){
        // 将所有边入最小堆
        $heap = new BinaryHeap($this->edges);
        $paths = [];

        $uf = new UnionFindQUHeight(100);


        while (!$heap->isEmpty()){
            /** @var Edge $edge */
            $edge = $heap->get();
            if(!$uf->isSame($edge->from, $edge->to)){
                $paths[] = $edge;
                $uf->union($edge->from, $edge->to);
            }

            var_dump(strval($edge) . ' '. $edge->weight);
        }
        return $paths;

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