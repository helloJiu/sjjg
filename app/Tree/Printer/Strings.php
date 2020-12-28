<?php

namespace App\Tree\Printer;

class Strings {
	public static function repeat($string, $count) {
		return str_repeat($string, $count);
	}
	
	public static function blank($length) {
		return str_repeat(' ', $length);
	}
}
