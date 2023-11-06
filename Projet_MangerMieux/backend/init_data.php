<?php
$sqlFile = 'manger_mieux.sql';
$sql = file_get_contents($sqlFile);
$pdo->exec($sql);

?>
