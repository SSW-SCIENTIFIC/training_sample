<?php

	/**
	 * Basic Chat Script
	 * 
	 * 極めて簡素なチャットスクリプト
	 * 投稿して表示する機能しかありません
	 * 
	 */

	/* 定数定義 */
	define('DSN', 'sqlite:'.__DIR__.'/log.db');
	define('MAX_NAME', 40);
	define('MAX_TEXT', 200);
	define('DEFAULT_NUM', 20);

	/* メインルーチンここから */
	
	$db = new PDO(DSN);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
	if(isset($_GET['mode']))
	{
		if($_GET['mode'] === 'write')
		{
			write();
			
			/* 書き込んだらView専用ページにリダイレクトしておく(リロードによる2重投稿防止) */
			header('Location: '.$_SERVER['PHP_SELF']);
			exit();
		}
		elseif($_GET['mode'] === 'create')
		{
			/* createモードでは, もしテーブルがなければ作成 */
			$sql = <<< EOL
CREATE TABLE IF NOT EXISTS chat_log
(
	id INTEGER PRIMARY KEY AUTOINCREMENT, 
	name VARCHAR(255) NOT NULL DEFAULT 'NO NAME', 
	text VARCHAR(255) NOT NULL, 
	ip VARCHAR(15) NOT NULL, 
	time TIMESTAMP NOT NULL
);
EOL;
			
			$db->exec($sql);
			header('Location: '.$_SERVER['PHP_SELF']);
			exit();
		}
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
		global $log, $db;
		
		if(!isset($_GET['n']))
		$limits = DEFAULT_NUM;
		elseif((int)$_GET['n'] === 0)
			$limits = (int)($db->query('SELECT COUNT(*) FROM chat_log;')->fetchColumn());
		else
			$limits = (int)$_GET['n'];
		
		
		$prepared = $db->prepare('SELECT id, name, text, time FROM chat_log ORDER BY id DESC LIMIT :limits;');
		$prepared->bindValue(':limits', $limits, PDO::PARAM_INT);
		$prepared->execute();
		$log = $prepared->fetchAll(PDO::FETCH_ASSOC);
	}
	
	/**
	 * This is function write
	 *
	 * POSTデータを処理してログに書き込む
	 *
	 */	
	function write()
	{
		global $db;
		
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
		
		$prepared = $db->prepare('INSERT INTO chat_log (name, text, ip, time) VALUES (:name, :text, :ip, :time);');
		$prepared->bindValue(':name', $_POST['name'], PDO::PARAM_STR);
		$prepared->bindValue(':text', $_POST['text'], PDO::PARAM_STR);
		$prepared->bindValue(':ip', $_SERVER['REMOTE_ADDR'], PDO::PARAM_STR);
		$prepared->bindValue(':time', time(), PDO::PARAM_INT);
		$prepared->execute();
		
		header('Location: '.$_SERVER['PHP_SELF']);
		exit();
	}

	/* 以下HTML出力 */

?><!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Basic Chat with Database</title>
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
		echo('<p><span style="width: 30px;display:inline-block;">'.$line['id'].'</span>: <strong style="width: 100px;display:inline-block;">'.htmlspecialchars($line['name']).'</strong> <span>'.htmlspecialchars($line['text']).'</span> <span style="color:#CCC;">'.date('Y-m-d H:i:s', $line['time']).'</span></p>'.PHP_EOL);
?>	</div>
</body>
</html>
