<?php

	/**
	 * Basic Chat Script
	 * 
	 * 極めて簡素なチャットスクリプト
	 * 投稿して表示する機能しかありません
	 * 
	 */

	/* 定数定義 */
	define('LOG_FILE', 'log.dat');
	define('MAX_NAME', 40);
	define('MAX_TEXT', 200);
	define('DEFAULT_NUM', 20);

	/* メインルーチンここから */

	if($_GET['mode'] === 'write')
	{
		write();
		
		/* 書き込んだらView専用ページにリダイレクトしておく(リロードによる2重投稿防止) */
		header('Location: '.$_SERVER['PHP_SELF']);
		exit();
	}

	$log = array();
	read();

	/* メインルーチンここまで */


	/**
	 * This is function read
	 *
	 * ファイルからログを読み出して $log に投入する
	 *
	 */	
	function read()
	{
		global $log;
		
		if(file_exists(LOG_FILE))
		{
			$file = file(LOG_FILE);
			
			if(!$file)
			{
				$file[0][1] = 'ファイル読み込みエラー';
			}
			
			/* GETで渡されるnの値で表示件数を調整 */
			if(!isset($_GET['n']))
				$lines = DEFAULT_NUM;
			elseif((int)$_GET['n'] === 0)
				$lines = count($file);
			else
				$lines = (int)$_GET['n'];
			
			/* ログの末尾から$lines件取り出す */
			for($i = count($file) - 1; $i > count($file) - $lines - 1; $i--)
			{
				if($i < 0) continue;
				$log[] = explode("\t", $file[$i]);
			}
		}
	}
	
	/**
	 * This is function write
	 *
	 * POSTデータを処理してログに書き込む
	 *
	 */	
	function write()
	{
		/* POSTデータ処理 */
		foreach($_POST as $key => &$value)
		{
			/* 改行文字除去(スペースに置換) */
			$value = preg_replace('/(?:\x0D\x0A|[\x0A\x0A])+/u', ' ', $value);
			/* コントロールコード除去 */
			$value = preg_replace('/[\x00-\x1f\x7f]/u', '', $value);
			
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
		{
			fgets($fp);
			$next++;
		}

		/* ファイルに書き出し                           */
		/* フォーマットは5カラム ID Name Text Host Time */
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

	/* 以下HTML出力 */

?><!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Basic Chat</title>
</head>
<body>
	<h1>Simple Chat</h1>
	<div>
		<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>?mode=write">
			<p><span style="width:60px;display:inline-block;">Name</span>: <input type="text" name="name" value="" size="<?php echo MAX_NAME; ?>"></p>
			<p><span style="width:60px;display:inline-block;">Message</span>: <input type="text" name="text" value="" size="<?php echo MAX_TEXT; ?>"></p>
			<p><input type="submit" name="submit" value="Submit"> <?php echo (isset($_GET['n']) && (int)$_GET['n'] === 0) ? '<a href='.$_SERVER['PHP_SELF'].'?n=20>Show Last 20</a>' : '<a href='.$_SERVER['PHP_SELF'].'?n=0>Show All</a>'; ?></p>
		</form>
	</div>
	<hr>
	<div>
<?php
	/* 時刻は分かりやすいようフォーマットして出力 */
	foreach($log as $line)
		echo('<p><span style="width: 30px;display:inline-block;">'.$line[0].'</span>: <strong style="width: 100px;display:inline-block;">'.htmlspecialchars($line[1]).'</strong> <span>'.htmlspecialchars($line[2]).'</span> <span style="color:#CCC;">'.date('Y-m-d H:i:s', $line[4]).'</span></p>'.PHP_EOL);
?>	</div>
</body>
</html>
