<?php

namespace App\Tree;

use App\Tree\Printer\TreePrinter;
use App\Util\RandUtil;

/**
 * Created by helloJiu.
 * Idea: 认真编码 快乐生活
 * Date: 2020/12/26
 * Time: 10:59
 */
require "../../vendor/autoload.php";

class TreeTest
{
    function testTrie(){
        $trie = new Trie();
        $trie->add('a', 'aaa-----------');
        $trie->add('aB', 1);
        $trie->add('aC', 2);
        $trie->add('aCD', 3);
        $trie->add('TOm', 4);
        $trie->add('中国ab1', 4);

        //var_dump($trie);
        var_dump($trie->get('aCD'));
        var_dump($trie->get('T'));
        var_dump($trie->get('中国ab1'));
        var_dump($trie->prefixExist('中国1'));

    }


    public static function testBinaryTree(){
        $tree = new BinarySearchTree();
        // $tree->add(4);
        // $tree->add(8);
        // $tree->add(3);
        // $tree->add(5);
        // $tree->add(12);
        // $tree->add(2);
        // $tree->add(9);
        // $tree->add(16);
        // $tree->add(6);
        // $tree->add(1);
        $persons = RandUtil::generatePersons(10, 100);
        foreach($persons as &$person){
            $tree->add($person);
        }

        (new TreePrinter($tree))->print();
    }
}

TreeTest::testBinaryTree();

