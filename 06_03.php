<?php

	class MyClass
	{
		const MY_CLASS_CONSTANT = 'MyClass Constant';
		
		public static function MyStaticFunction()
		{
			echo 'MyClass::MyStaticFunction';
		}
	};
	
	echo MyClass::MY_CLASS_CONSTANT.PHP_EOL;
	
	MyClass::MyStaticFunction();
	
	
	$object = new MyClass;
	$object->MyStaticFunction();  // 呼べるけど呼ばない方がよい
	