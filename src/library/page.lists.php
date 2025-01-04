<h2>Vortlistoj</h2>

<?php

$wl = new WordList($db);
$wordlists = $wl->get_all_list_names();

echo "<table>";
echo "<tr><th>Titolo</th><th>Vortoj</th><th></th></tr>";

foreach ($wordlists as $list) {
    echo "<tr><td><a href=\"index.php?page=words&session=$sessionid&list=" . htmlspecialchars($list['id']) . "\">" 
         . htmlspecialchars($list['title']) . "</a></td><td>" . $list['len'] . "</td><td><a href=\"index.php?page=quiz&session=$sessionid&list=" . htmlspecialchars($list['id']) . "\">Kvizo</a></tr>";
}

echo "</table>";

?>

<br><a href="index.php?page=addlist&session=<?php echo $sessionid ?>">Aldoni liston</a><br>