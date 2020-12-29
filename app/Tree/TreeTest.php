<?php

namespace App\Tree;

use App\Entry\Person;
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
        $a = [];
        $p = new Person(1, 2);
        $a[strval($p)] = 1;
        var_dump(isset($a[strval($p)]));
        return;
        $tree = new BinarySearchTree();
        $ints = RandUtil::getIntegers(20, 100);
        foreach($ints as $int){
            $tree->add($int);
        }
        // $persons = RandUtil::generatePersons(10, 100);
        // foreach($persons as &$person){
        //     $tree->add($person);
        // }

        (new TreePrinter($tree))->print();
        var_dump($tree->contains(11));
        var_dump($tree->contains(1));
        var_dump($tree->contains(16));
    }
}

TreeTest::testBinaryTree();

