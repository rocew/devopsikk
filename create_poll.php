<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $db = new PDO("pgsql:host=db;dbname=polls_db", "user", "pass");
    $stmt = $db->prepare("INSERT INTO polls (question) VALUES (?) RETURNING id");
    $stmt->execute([$_POST['question']]);
    $pollId = $stmt->fetchColumn();

    $stmt = $db->prepare("INSERT INTO options (poll_id, option_text) VALUES (?, ?)");
    foreach ($_POST['options'] as $text) {
        if (trim($text) !== '') $stmt->execute([$pollId, $text]);
    }
    header("Location: index.php"); exit;
}
?>
<!DOCTYPE html>
<html>
<head><link rel="stylesheet" href="style.css"></head>
<body>
<div class="container">
    <h2>Новый опрос</h2>
    <form method="post">
        <input type="text" name="question" placeholder="Ваш вопрос" required>
        <input type="text" name="options[]" placeholder="Вариант 1" required>
        <input type="text" name="options[]" placeholder="Вариант 2" required>
        <input type="text" name="options[]" placeholder="Вариант 3">
        <button type="submit">Создать</button>
    </form>
    <p align="center"><a href="index.php">Назад</a></p>
</div>
</body>
</html>
