<?php
if (isset($_GET['id'])) {
    $db = new PDO("pgsql:host=db;dbname=polls_db", "user", "pass");
    $db->prepare("DELETE FROM polls WHERE id = ?")->execute([$_GET['id']]);
}
header("Location: index.php");
