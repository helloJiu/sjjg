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

}