<h2>Vortlistoj</h2>

<?php

$wl = new WordList($db);
$wordlists = $wl->get_all_list_names();

foreach ($wordlists as $list) {
    echo "<a href=\"index.php?page=words&session=$sessionid&list=" . htmlspecialchars($list['id']) . "\">" 
         . htmlspecialchars($list['title']) . "</a> (" . $list['len'] . " vortoj)<br>";
}

?>

<br><a href="index.php?page=addlist&session=<?php echo $sessionid ?>">Aldoni liston</a><br>