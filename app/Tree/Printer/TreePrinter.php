<?php

namespace App\Tree\Printer;

/***

             ┌──800
         ┌──760
         │   └──600
     ┌──540
     │   └──476
     │       └──445
 ┌──410
 │   └──394
381
 │     ┌──190
 │     │   └──146
 │  ┌──40
 │  │  └──35
 └──12
    └──9

 */
class TreePrinter {
	// public function printString() {
	// 	$string = $this->tree->root(). "". "". "";
	// 	return $string;
	// }

    /**
     * 二叉树的基本信息
     */
    protected $tree;

    protected $rightAppend;
    protected $leftAppend;
    protected $blankAppend;
    protected $lineAppend;
    protected $length = 2;


    private function initAttr(){
        $this->rightAppend = "┌" . Strings::repeat("─", $this->length);
        $this->leftAppend = "└" . Strings::repeat("─", $this->length);
        $this->blankAppend = Strings::blank($this->length);
        $this->lineAppend = "│" . Strings::blank($this->length);
    }

    public function __construct(BinaryTreePrinterInterface $tree)
    {
        $this->tree = $tree;
        $this->initAttr();
    }

    /**
     * 打印后换行
     */
    public function println()
    {
        echo PHP_EOL;
    }

    /**
     * 打印
     */
    public function print()
    {
        echo $this->printString($this->tree->root(), '', '', '');
    }

    /**
     * 生成node节点的字符串
     * @param $node
     * @param $nodePrefix
     * @param $leftPrefix
     * @param $rightPrefix
     * @return string
     */
	public function printString($node, $nodePrefix,$leftPrefix, $rightPrefix) {
        echo '--'. $leftPrefix . '--'.PHP_EOL;
        echo '----------'.PHP_EOL;
		$left = $this->tree->left($node);
		$right = $this->tree->right($node);
		$string = $this->tree->string($node);
		
		$length = strlen($string);
		if ($length % 2 == 0) {
            $length--;
		}
        $length >>= 1;
		
		$nodeString = "";
		if ($right != null) {
			$rightPrefix .= Strings::blank($length);
			$nodeString .= $this->printString($right,
                $rightPrefix . $this->rightAppend,
                $rightPrefix . $this->lineAppend,
                $rightPrefix . $this->blankAppend);
		}
		$nodeString .= $nodePrefix . $string . PHP_EOL;
		if ($left != null) {
			$leftPrefix .= Strings::blank($length);
			$nodeString .= $this->printString($left,
					$leftPrefix . $this->leftAppend,
					$leftPrefix . $this->blankAppend,
					$leftPrefix . $this->lineAppend);
		}

		return $nodeString;
	}
}
