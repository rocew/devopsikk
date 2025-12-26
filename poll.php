<?php
$db = new PDO("pgsql:host=db;dbname=polls_db", "user", "pass");
if (isset($_POST['option_id'])) {
    $db->prepare("UPDATE options SET votes = votes + 1 WHERE id = ?")->execute([$_POST['option_id']]);
}
$stmt = $db->prepare("SELECT * FROM polls WHERE id = ?");
$stmt->execute([$_GET['id']]);
$poll = $stmt->fetch();
$stmt = $db->prepare("SELECT * FROM options WHERE poll_id = ? ORDER BY id");
$stmt->execute([$_GET['id']]);
$options = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html>
<head><link rel="stylesheet" href="style.css"></head>
<body>
<div class="container">
    <h2><?= htmlspecialchars($poll['question']) ?></h2>
    <form method="post">
        <?php foreach ($options as $opt): ?>
            <button name="option_id" value="<?= $opt['id'] ?>" class="vote-btn">
                <?= htmlspecialchars($opt['option_text']) ?>
                <span class="badge"><?= $opt['votes'] ?></span>
            </button>
        <?php endforeach; ?>
    </form>
    <p align="center"><a href="index.php">← К списку</a></p>
</div>
</body>
</html>
