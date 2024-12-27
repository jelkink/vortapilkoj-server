<h2>Vortlistoj</h2>

<?php

$res = $db->query("SELECT id, title FROM wordlists ORDER BY title");
$wordlists = $res->fetchAll(PDO::FETCH_ASSOC);

foreach ($wordlists as $list) {
    echo "<a href=\"index.php?page=words&list=" . htmlspecialchars($list['id']) . "\">" 
         . htmlspecialchars($list['title']) . "</a><br>";
}

?>

<br><a href="index.php?page=addlist">Aldoni liston</a><br>