<?php

	/* PHP�}�j���A���̃T���v�� �}�}               */
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
	$foo->printItem('baz'); // �o��: 'Foo: baz'
	$foo->printPHP();       // �o��: 'PHP is great' 
	$bar->printItem('baz'); // �o��: 'Bar: baz'
	$bar->printPHP();       // �o��: 'PHP is great'

