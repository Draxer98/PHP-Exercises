<?php
$config = require '../../config/database.php';
try {
    $dsn = "mysql:host={$config['host']};dbname={$config['database']};charset=utf8";
    $pdo = new PDO($dsn, $config['user'], $config['password'], $config['pdooptions']);
} catch (PDOException $e) {
    die("Errore connessione DB: " . $e->getMessage());
}

$post_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($post_id <= 0) {
    echo "Post non trovato.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['comment']) && !empty($_POST['email'])) {
    $comment = trim($_POST['comment']);
    $email = trim($_POST['email']);
    $datecreated = date('Y-m-d H:i:s');

    $stmt_insert = $pdo->prepare("INSERT INTO postscomments (post_id, comment, email, datecreated) VALUES (:post_id, :comment, :email, :datecreated)");
    $stmt_insert->execute([
        'post_id' => $post_id,
        'comment' => $comment,
        'email' => $email,
        'datecreated' => $datecreated,
    ]);
    header("Location: post.php?id=" . $post_id);
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM posts WHERE id = :post_id");
$stmt->execute(['post_id' => $post_id]);
$post = $stmt->fetch(PDO::FETCH_OBJ);

if (!$post) {
    echo "Post non trovato.";
    exit;
}

$stmt_comments = $pdo->prepare("SELECT * FROM postscomments WHERE post_id = :post_id ORDER BY datecreated DESC");
$stmt_comments->execute(['post_id' => $post_id]);
$comments = $stmt_comments->fetchAll(PDO::FETCH_OBJ);
?>

<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($post->title) ?></title>
    <link rel="stylesheet" href="../../public/css/style.css">
</head>

<body class="postpage">
    <a href="../../public/index.php" class="btn btn-secondary" style="position: absolute; top: 30px; right: 40px; z-index: 1000; ">
        &larr; Back to home
    </a>
    <div class="container mt-5">
        <div class="post mb-5 p-5 bg-light rounded-3">
            <h2><?= htmlspecialchars($post->title) ?></h2>
            <p><?= nl2br(htmlspecialchars($post->message ?? 'No content available')) ?></p>
            <small>Published on: <?= $post->datecreated ? date('d-m-Y', strtotime($post->datecreated)) : 'Unknown date' ?></small>
            <hr>
            <h3>Comments</h3>
            <div class="comments">
                <?php if ($comments && count($comments) > 0): ?>
                    <?php foreach ($comments as $comment): ?>
                        <div class="comment mb-4">
                            <p><strong><?= htmlspecialchars($comment->email) ?>:</strong> <?= nl2br(htmlspecialchars($comment->comment)) ?></p>
                            <small>Commented on: <?= date('d-m-Y H:i', strtotime($comment->datecreated)) ?></small>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No comments yet.</p>
                <?php endif; ?>
            </div>

            <h4>Add a comment</h4>
            <form method="post" action="post.php?id=<?= $post->id ?>">
                <div class="mb-5">
                    <textarea name="comment" class="form-control" placeholder="Add comment..." rows="4" required></textarea>
                </div>
                <div class="mb-5">
                    <input type="email" name="email" class="form-control" placeholder="Your email" required />
                </div>
                <button type="submit" class="btn btn-primary">Submit Comment</button>
            </form>
        </div>
    </div>

    <?php

    require '../../layout/footer.php';
