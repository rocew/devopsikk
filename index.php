<?php
$db = new PDO("pgsql:host=db;dbname=polls_db", "user", "pass");
$polls = $db->query("SELECT * FROM polls ORDER BY id DESC")->fetchAll();
?>
<!DOCTYPE html>
<html>
<head><link rel="stylesheet" href="style.css"><title>Опросы</title></head>
<body>
<div class="container">
    <h1>Опросы</h1>
    <a href="create_poll.php" style="display:block; text-align:center; margin-bottom:20px;">+ Создать новый опрос</a>
    <?php foreach ($polls as $poll): ?>
        <div class="poll-item">
            <a href="poll.php?id=<?= $poll['id'] ?>" class="poll-link"><?= htmlspecialchars($poll['question']) ?></a>
            <a href="delete_poll.php?id=<?= $poll['id'] ?>" class="del-btn" onclick="return confirm('Удалить?')">&times;</a>
        </div>
    <?php endforeach; ?>
</div>
</body>
</html>
