<form class="container mt-5" method="post">
    <div class="posts mb-5 p-5 bg-light rounded-3">
        <?php if (count($posts) > 0): ?>
            <div class="row">
                <?php foreach ($posts as $post): ?>
                    <div class="col-md-4 mb-4">
                        <div class="post p-3 bg-white rounded shadow">
                            <h2><?= htmlspecialchars($post->title) ?></h2>
                            <p><?= nl2br(htmlspecialchars($post->message ?? 'No content available')) ?></p>
                            <small>Published on: <?= $post->datecreated ? date('d-m-Y', strtotime($post->datecreated)) : 'Unknown date' ?></small>
                            <a href="../app/view/post.php?id=<?= $post->id ?>" class="btn btn-info mt-2">Open</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p>No posts found.</p>
        <?php endif; ?>
    </div>
</form>