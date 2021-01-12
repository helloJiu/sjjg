<?php
/**
 * Created by helloJiu.
 * Idea: 认真编码 快乐生活
 * Date: 2020/12/29
 * Time: 21:55
 */

namespace App\Graph;

use App\Util\PrintUtil;

require "../../vendor/autoload.php";

class GraphTest
{
    public function test(){
        $graph = new Graph();
        $graph->addEdge('E', 'A', 30);
        $graph->addEdge('A', 'G', 100);
        $graph->addEdge('A', 'D', 80);
        $graph->addEdge('A', 'E', 50);
        $graph->addEdge('E', 'F', 20);
        $graph->addEdge('F', 'G', 10);
        $graph->addEdge('E', 'D', 10);
        $graph->addEdge('E', 'B', 20);
        $graph->addEdge('H', 'I', 20);

        // $graph->print();
        // $data = $graph->getShortPaths('A');

        $paths = $graph->mst();
        print_r($paths);


        $graph->print();
        $visitor = function ($v){
            PrintUtil::println($v);
        };

        $graph->bfs('V1');
        PrintUtil::println('-------------');
        $graph->dfsByRecusion('V1', $visitor);
        PrintUtil::println('-------------');
        $graph->dfsByLoop('V1', $visitor);



    }
}

(new GraphTest())->test();