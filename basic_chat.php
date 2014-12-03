<?php

	define('LOG_FILE', 'log.dat');
	define('MAX_NAME', 40);
	define('MAX_TEXT', 200);

	if($_SERVER['QUERY_STRING'] === 'write')
	{
		write();
		header('Location: '.$_SERVER['PHP_SELF']);
		exit();
	}

	read();

	function read()
	{
		$log = array();
		
		if(file_exists(LOG_FILE))
		{
			$file = file(LOG_FILE);
			
			if(!$file)
			{
				$file[0][1] = 'ファイル読み込みエラー';
			}
			
			if(empty($_GET['n']))
				$lines = 20;
			else
				$lines = $_GET['n'];
			
			for($i = count($file) - $lines - 1; $i < count($file); $i++)
				$array[] = explode("\t", $file[$i]);
		}
	}
	
	function write()
	{
		/* POSTデータ処理 */
		foreach($_POST as $key => &$value)
		{
			/* 改行文字除去 */
			$value = preg_replace('/(?:\x0D\x0A|[\x0A\x0A])+/ug', ' ', $value);
			/* コントロールコード除去 */
			$value = preg_replace('/[\0x00-\0x1f\0x7f]/ug', '', $value);
			
			if($key === 'name')
			{
				if(strlen($value) > MAX_NAME)
				$value = substr($value, 0, MAX_NAME);
				
				continue;
			}
			
			if($key === 'text')
			{
				if(strlen($value) > MAX_TEXT)
				$value = substr($value, 0, MAX_TEXT);
				
				continue;
			}
		}
		
		if(!($fp = fopen(LOG_FILE, 'a+')))
			exit('ファイル書き込みエラー');

		flock($fp, LOCK_EX);

		fseek($fp, 0, SEEK_SET);
		$next = 0;
		
		while(!feof($fp))
			$next++;

		fwrite(
			$fp, 
			implode(
					"\t", 
					array($next, $_POST['name'], $_POST['text'], gethostbyaddr($_SERVER['REMOTE_ADDR']), time())
					).PHP_EOL
		);
	
		flock($fp, LOCK_UN);
		fclose($fp);
		
		header('Location: '.$_SERVER['PHP_SELF']);
		exit();
	}

?><!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Basic Chat</title>
</head>
<body>
	<h1>Simple Chat</h1>
	<div>
		<form method="POST" action="<?php echo $_POST['PHP_SELF']; ?>">
			<p><span style="width=50px">Name</span>: <input type="text" name="name" value="" size="<?php echo MAX_NAME; ?>"></p>
			<p><span style="width=50px">Message</span>: <input type="text" name="name" value="" size="<?php echo MAX_TEXT; ?>"></p>
		</form>
	</div>
</body>
</html>
