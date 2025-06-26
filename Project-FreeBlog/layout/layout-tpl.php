<!DOCTYPE html>
<html lang="en" class="h-100" data-bs-theme="auto">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>BLOGGING ONLINE</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Modak&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../public/css/index.css" />
    <link rel="stylesheet" href="../public/css/style.css" />
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
                        <li class="nav-item"><a class="nav-link active" href="#">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Link</a></li>
                    </ul>
                    <form class="d-flex" role="search">
                        <input class="form-control me-2" type="search" placeholder="Search..." aria-label="Search">
                        <button class="btn btn-info" type="submit">Search</button>
                    </form>
                </div>
            </div>
        </nav>
    </header>

    <main class="flex-shrink-0 pt-6">
        <h1>BLOGGING ONLINE</h1>
        <div class="content">
            <?= $this->content ?>
        </div>
    </main>

    <footer class="footer py-3 mt-auto bg-body-tertiary">
        <div class="container" style="text-align: center">
            <span class="text-body-secondary">&copy; all rights reserved</span>
        </div>
    </footer>

    <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js'></script>
</body>

</html>