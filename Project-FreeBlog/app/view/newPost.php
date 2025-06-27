<?php
$config = require '../../config/database.php';
try {
    $dsn = "mysql:host={$config['host']};dbname={$config['database']};charset=utf8";
    $pdo = new PDO($dsn, $config['user'], $config['password'], $config['pdooptions']);
} catch (PDOException $e) {
    die("Errore connessione DB: " . $e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['title']) && !empty($_POST['author']) && !empty($_POST['content'])) {
    $title = trim($_POST['title']);
    $email = trim($_POST['author']);
    $message = trim($_POST['content']);
    $datecreated = date('Y-m-d H:i:s');

    $stmt = $pdo->prepare("INSERT INTO posts (title, message, datecreated, email) VALUES (:title, :message, :datecreated, :email)");
    $stmt->execute([
        'title' => $title,
        'message' => $message,
        'datecreated' => $datecreated,
        'email' => $email,
    ]);
    header("Location: ../../public/index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en" class="h-100" data-bs-theme="auto">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>BLOGGING ONLINE</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Modak&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../public/css/index.css" />
    <link rel="stylesheet" href="../../public/css/style.css" />
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body class="d-flex flex-column h-100">
    <header>
        <nav class="navbar navbar-expand-md navbar fixed-top navbar-color">
            <div class="container-fluid">
                <a class="navbar-brand" href="#"><i class="fa-solid fa-blog fa-2xl"></i></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="navbar-nav me-auto mb-2 mb-md-0">
                        <li class="nav-item"><a class="nav-link active" href="../../public/index.php">Home</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <main class="flex-shrink-0 pt-6">
        <div class="container mt-5" style="max-width: 600px;">
            <h3 class="mb-4 text-center h3newpost">CREATE A NEW POST</h3>
            <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
                <div class="mb-3">
                    <label for="postTitle" class="form-label">POST TITLE</label>
                    <input type="text" class="form-control" id="postTitle" name="title" placeholder="Enter the post title" required>
                </div>
                <div class="mb-3">
                    <label for="postAuthor" class="form-label">EMAIL</label>
                    <input type="text" class="form-control" id="postAuthor" name="author" placeholder="Your Email" required>
                </div>
                <div class="mb-3">
                    <label for="postContent" class="form-label">Contenuto</label>
                    <textarea class="form-control" id="postContent" name="content" rows="6" placeholder="Write the content of the post here..." required></textarea>
                </div>
                <button type="submit" class="btn btn-primary w-100">Publish</button>
            </form>
        </div>
    </main>
    <?php
    require '../../layout/footer.php';
