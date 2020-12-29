<?php
/**
 * Created by helloJiu.
 * Idea: 认真编码 快乐生活
 * Date: 2020/12/29
 * Time: 21:55
 */

namespace App\Graph;

require "../../vendor/autoload.php";

class GraphTest
{
    public function test(){
        $graph = new Graph();
        $graph->addEdge(1,2);
        $graph->addEdge(2,3);
        $graph->addEdge(4,5);
        $graph->addEdge(1,3);
        $graph->addEdge(4,2);

        $graph->print();
    }
}

(new GraphTest())->test();