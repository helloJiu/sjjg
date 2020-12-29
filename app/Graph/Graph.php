<?php
/**
 * Created by helloJiu.
 * Idea: 认真编码 快乐生活
 * Date: 2020/12/29
 * Time: 21:01
 */

namespace App\Graph;


use App\Util\PrintUtil;

class Graph
{
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

    public function print(){
        echo "顶点:----------" . PHP_EOL;
        foreach ($this->vertices as &$vertex){
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
        if(isset($this->vertices[strval($v)])){
            return;
        }
        $this->vertices[strval($v)] = new Vertex($v);
    }

    /**
     * @param $from_v
     * @param $to_v
     * @param int $weight
     */
    public function addEdge($from_v, $to_v, $weight = 0){
        $str_from_v = strval($from_v);
        if(empty($this->vertices[$str_from_v])){
            $this->vertices[$str_from_v] = new Vertex($from_v);
        }
        $from_vertex = $this->vertices[$str_from_v];

        $str_to_v = strval($to_v);
        if(empty($this->vertices[$str_to_v])){
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


}