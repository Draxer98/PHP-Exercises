<?php

$currentUrl = $_SERVER['PHP_SELF'];
$indexPage = 'index.php';
$action = $_GET['action'] ?? null;
$indexActive = !$action ? 'active' : '';
$newActive = $action === 'insert' ? 'active' : '';

?>
<header>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><i class="fa-solid fa-globe fa-2xl"></i></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav me-auto mb-2 mb-md-0">
                    <?php if(isUserAdmin()) { ?>
                    <li class="nav-item"> <a class="nav-link <?= $newActive ?>" aria-current="page" href="<?= $indexPage ?>?action=insert"><i class="fa-solid fa-user-plus"></i> New User</a> </li>
                    <?php } ?>
                    <li class="nav-item"> <a class="nav-link <?= $indexActive ?>" href="<?= $indexPage ?>"><i class="fa-solid fa-users"></i> Users </a> </li>
                </ul>
                <div class="col-auto">
                    <input name="search" value="<?= $search ?>" class="form-control" type="search" placeholder="Search..." aria-label="Search">
                </div>

                <div class="col-auto">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </div>

                <div class="col-auto">
                    <button onclick="location.href='index.php'" class="btn btn-outline-info" type="button">Reset</button>
                </div>
                <ul class="navbar-nav ms-auto mb-2 mb-md-0">
                    <?php if (isUserLoggedin()) { ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa-solid fa-user"></i> <?= htmlspecialchars(getUserLoggedInFullname()) ?>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                <li><a class="dropdown-item" href="view/logout.php"><i class="fa-solid fa-right-from-bracket"></i>Logout</a></li>
                            </ul>
                        </li>
                    <?php } else { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="../login.php"><i class="fa-solid fa-right-to-bracket"></i> Login</a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>

    </nav>
</header>