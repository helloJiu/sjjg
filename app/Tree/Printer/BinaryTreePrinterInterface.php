<?php

namespace App\Tree\Printer;

interface BinaryTreePrinterInterface {
	/**
	 * who is the root node
	 */
	public function root();
	/**
	 * how to get the left child of the node
	 */
	public function left($node);
	/**
	 * how to get the right child of the node
	 */
	public function right($node);
	/**
	 * how to print the node
	 */
	public function string($node);
}
