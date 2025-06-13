<?php

$currentUrl = $_SERVER['PHP_SELF'];
$indexPage = 'index.php';
$action = $_GET['action'] ?? null;
$indexActive = !$action ? 'active' : '';
$newActive = $action === 'insert' ? 'active' : '';

?>
<header>
    <!-- Fixed navbar -->
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <div class="container-fluid"> <a class="navbar-brand" href="#"><i class="fa-solid fa-globe fa-2xl"></i></a> <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav me-auto mb-2 mb-md-0">
                    <li class="nav-item"> <a class="nav-link <?= $newActive ?>" aria-current="page" href="<?= $newActive ?>?action=insert"><i class="fa-solid fa-user-plus"></i>New User</a> </li>
                    <li class="nav-item"> <a class="nav-link <?= $indexActive ?>" href="<?= $newActive ?>"><i class="fa-solid fa-users"></i> Users </a> </li>
                    <li class="nav-item"> <a class="nav-link disabled" aria-disabled="true">Disabled</a> </li>
                </ul>
                <form class="g-3" method="GET" role="search" id="searchForm">
                    <div class="row">
                        <div class="col">
                            <label class="form-label" for="recordsPerPage"> RECORDS </label>
                        </div>
                        <div class="col">
                            <select class="form-select" name="recordsPerPage" name="recordsPerPage" onchange="document.forms.searchForm.submit()">
                                <option value="">SELECT</option>
                                <?php
                                foreach ($recordsPerPageOptions as $v) {
                                    $s = (int) $v;
                                    $selected = $v == $recordsPerPage ? 'selected' : '';
                                    echo "<option $selected value='$v'>$v</option> \n";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col">
                            <input name="search" value="<?= $search ?>" class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        </div>
                        <div class="col">
                            <button class="btn btn-outline-success" type="submit">Search</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </nav>
</header>