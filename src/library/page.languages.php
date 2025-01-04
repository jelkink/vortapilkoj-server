<h2>Lingvoj</h2>

<?php

$result = $db->query("SELECT languages.id, languages.name, COUNT(DISTINCT unified_words.id) AS cnt FROM languages LEFT JOIN (SELECT language1 AS language_id, id FROM words UNION SELECT language2 AS language_id, id FROM words) AS unified_words ON languages.id = unified_words.language_id GROUP BY languages.id ORDER BY languages.name;");
$langs = $result->fetchAll(PDO::FETCH_ASSOC);

echo "<table>";
foreach ($langs as $lang) {
    echo "<tr><td>" . htmlspecialchars($lang['name']) . "</td><td>" . $lang['cnt'] . "</td><td><a href=\"index.php?page=words&session=$sessionid&language=" . $lang['id'] . "\">Vortoj</a></td></tr>";
}
echo "</table>";

?>

<br><a href="index.php?page=addlang&session=<?php echo $sessionid ?>">Aldoni lingvon</a><br>