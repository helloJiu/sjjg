<?php
/**
 * User: helloJiu
 * Date: 2020/12/29
 * Time: 10:09
 */

namespace App\Tree;


class NotFoundException extends \Exception
{
    protected $message = 'Not Found Node';
}