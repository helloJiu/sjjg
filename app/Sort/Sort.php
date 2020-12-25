<?php
/**
 * User: helloJiu
 * Date: 2020/12/25
 * Time: 17:10
 */

namespace app\Sort;


class Sort
{
    protected $comparor;

    protected $data;

    public function setComparor($comparor){
        $this->comparor = $comparor;
    }

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function sort(){

    }

    protected function compare($e1, $e2){
        if(!$this->comparor){
            return $e1 > $e2;
        }

        return call_user_func($this->comparor, $e1, $e2);
    }

    public function getData(){
        return $this->data;
    }

}