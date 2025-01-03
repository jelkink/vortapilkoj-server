<h2>Lingvoj</h2>

<?php

$result = $db->query("SELECT languages.id, languages.name, COUNT(words.word1) AS cnt FROM languages LEFT JOIN words ON languages.id = words.language1 OR languages.id = words.language2 GROUP BY languages.id ORDER BY languages.name");
$langs = $result->fetchAll(PDO::FETCH_ASSOC);

echo "<table>";
foreach ($langs as $lang) {
    echo "<tr><td>" . htmlspecialchars($lang['name']) . "</td><td>" . $lang['cnt'] . "</td></tr>";
}
echo "</table>";

?>

<br><a href="index.php?page=addlang">Aldoni lingvon</a><br>