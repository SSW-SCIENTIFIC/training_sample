<?php

	/* PHPマニュアルのサンプル ママ               */
	/* http://php.net/manual/ja/language.oop5.php */

	class Foo
	{
		public function printItem($string)
		{
			echo 'Foo: ' . $string . PHP_EOL;
		}
    
		public function printPHP()
		{
			echo 'PHP is great.' . PHP_EOL;
		}
	}

	class Bar extends Foo
	{
		public function printItem($string)
		{
			echo 'Bar: ' . $string . PHP_EOL;
		}
	}

	$foo = new Foo();
	$bar = new Bar();
	$foo->printItem('baz'); // 出力: 'Foo: baz'
	$foo->printPHP();       // 出力: 'PHP is great' 
	$bar->printItem('baz'); // 出力: 'Bar: baz'
	$bar->printPHP();       // 出力: 'PHP is great'

