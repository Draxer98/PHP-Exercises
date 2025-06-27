<?php
require 'header.php';
?>

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
                        <li class="nav-item"><a class="nav-link" href="../app/view/newPost.php"> <i class="fa-solid fa-plus"></i> New Post</a></li>
                    </ul>
                    <form class="d-flex" role="search" method="get" action="../public/index.php">
                        <input class="form-control me-2" type="search" name="q" placeholder="Search..." aria-label="Search">
                        <button class="btn btn-info" type="submit">Search</button>
                    </form>
                </div>
            </div>
        </nav>
    </header>

    <main class="flex-shrink-0 pt-6">
        <h1>BLOGGING ONLINE <i class="fa-solid fa-otter"></i> </h1>
        <div class="content">
            <?= $this->content ?>
        </div>
    </main>
    <?php
    require 'footer.php';
