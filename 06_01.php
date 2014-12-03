<?php

	$db = new PDO('pgsql:host=localhost;port=5432;dbname=testdb;', 'testuser', '****');

	$prepared = $db->prepare('SELECT id, name FROM score_sheet WHERE math > :math_score;');
	$prepared->bindValue(':math_score', 60, PDO::PARAM_INT);
	$prepared->execute();

	while($result = $prepared->fetch(PDO::FETCH_ASSOC))
		echo($result['id'].' '.$result['name'].PHP_EOL);

?>