<?php
/**
 * User: helloJiu
 * Date: 2021/1/12
 * Time: 14:15
 */

namespace App\Exception;

class NotFoundException extends \Exception
{
    protected $message = 'Not Found';
}