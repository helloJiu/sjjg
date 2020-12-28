<?php
/**
 * User: helloJiu
 * Date: 2020/12/28
 * Time: 16:07
 */

namespace App\Entry;


interface Comparator
{
    public function compare($e2);
}