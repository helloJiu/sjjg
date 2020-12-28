<?php
/**
 * User: helloJiu
 * Date: 2020/12/25
 * Time: 17:20
 */
namespace App\Entry;


class Person
{
    public $id;

    public $name;

    public function __construct($id, $name)
    {
        $this->name = $name;
        $this->id = $id;
    }

    public function compare(Person $p2){
        return $this->id - $p2->id;
    }

    public function __toString()
    {
        return $this->id . ':'. $this->name;
    }

}