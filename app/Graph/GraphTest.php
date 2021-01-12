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
        $graph->addEdge('V1', 'V0', 9);
        $graph->addEdge('V1', 'V2', 8);
        // $graph->addEdge('V0', 'V3', 7);
        $graph->addEdge('V2', 'V0', 7);
        $graph->addEdge('V2', 'V3', 2);
        $graph->addEdge('V6', 'V7', 12);
        $graph->addEdge('V3', 'V6', 12);
        $graph->addEdge('V3', 'V4', 1);

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