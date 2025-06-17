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
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><i class="fa-solid fa-globe fa-2xl"></i></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav me-auto mb-2 mb-md-0">
                    <li class="nav-item"> <a class="nav-link <?= $newActive ?>" aria-current="page" href="<?= $newActive ?>?action=insert"><i class="fa-solid fa-user-plus"></i>New User</a> </li>
                    <li class="nav-item"> <a class="nav-link <?= $indexActive ?>" href="<?= $newActive ?>"><i class="fa-solid fa-users"></i> Users </a> </li>
                    <li class="nav-item"> <a class="nav-link disabled" aria-disabled="true">Disabled</a> </li>
                </ul>
                <form class="row g-2 align-items-center" method="GET" role="search" name="searchForm" id="searchForm">
                    <div class="col-auto">
                        <div class="col">
                            <label class="form-label text-bg-dark" for="orderBy">ORDER BY :</label>
                        </div>
                        <select class="form-select" name="orderBy" onchange="document.forms.searchForm.submit()">
                            <?php
                            foreach ($orderByColumns as $col) {
                                $selected = $col === $orderBy ? 'selected' : '';
                                echo "<option $selected value=$col>" . strtoupper($col) . "</option>\n";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="col-auto">
                        <div class="col">
                            <label class="form-label text-bg-dark" for="orderDir">ORDER DIR :</label>
                        </div>
                        <select class="form-select" name="orderDir" onchange="document.forms.searchForm.submit()">
                            <option value="ASC" <?= $currentOrderDir === 'ASC' ? 'selected' : '' ?>>ASC</option>
                            <option value="DESC" <?= $currentOrderDir === 'DESC' ? 'selected' : '' ?>>DESC</option>
                        </select>
                    </div>

                    <div class="col-auto">
                        <div class="col">
                            <label class="form-label text-bg-dark" for="orderBy">VIEW :</label>
                        </div>
                        <select class="form-select" name="recordsPerPage" onchange="document.forms.searchForm.submit()">
                            <?php
                            foreach ($recordsPerPageOptions as $v) {
                                $selected = $v == $recordsPerPage ? 'selected' : '';
                                echo "<option $selected value='$v'>$v</option>\n";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="col-auto">
                        <input name="search" value="<?= $search ?>" class="form-control" type="search" placeholder="Search..." aria-label="Search">
                    </div>

                    <div class="col-auto">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </div>

                    <div class="col-auto">
                        <button onclick="location.href='index.php'" class="btn btn-outline-info" type="button">Reset</button>
                    </div>
                </form>
            </div>
        </div>
    </nav>
</header>