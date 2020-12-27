<?php
use App\Tree\Trie;

/**
 * Created by helloJiu.
 * Idea: 认真编码 快乐生活
 * Date: 2020/12/26
 * Time: 10:59
 */
class SingleTest
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
}