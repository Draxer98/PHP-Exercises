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
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title><?= htmlspecialchars($post->title) ?></title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Modak&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../public/css/index.css" />
    <link rel="stylesheet" href="../../public/css/style.css" />
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body class="postpage">
    <header>
        <nav class="navbar navbar-expand-md navbar fixed-top navbar-color">
            <div class="container-fluid">
                <a class="navbar-brand" href="#"><i class="fa-solid fa-blog fa-2xl"></i></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="navbar-nav me-auto mb-2 mb-md-0">
                        <li class="nav-item"><a class="nav-link active" href="../../public/index.php"> <i class="fa-solid fa-house"></i> Home</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
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
                <div class="mb-4">
                    <textarea name="comment" class="form-control" placeholder="Add comment..." rows="4" required></textarea>
                </div>
                <div class="mb-4">
                    <input type="email" name="email" class="form-control" placeholder="Your email" required />
                </div>
                <button class="btn btn-info" type="submit">Submit comment</button>
            </form>
        </div>
    </div>

    <?php

    require '../../layout/footer.php';
