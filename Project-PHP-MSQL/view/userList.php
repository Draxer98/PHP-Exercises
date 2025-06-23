<?php
$currentOrderDir = $currentOrderDir === 'ASC' ? 'ASC' : 'DESC';
require 'view/top.php';
require 'view/nav.php';
?>

<table class="table table-dark table-striped">
    <caption class="caption"><i class="fa-solid fa-users"></i>| USERS LIST | <i class="founds"> <?= $totalRecords ?> records found </i> </caption>
    <thead>
        <tr>
            <th>
                AVATAR
            </th>
            <th class="<?= $orderBy === 'id' ? $currentOrderDir : '' ?>">
                <a>ID</a>
            </th>

            <th class="<?= $orderBy === 'username' ? $currentOrderDir : '' ?>">
                <a>USERNAME</a>
            </th>

            <th class="<?= $orderBy === 'roleType' ? $currentOrderDir : '' ?>">
                <a>ROLE</a>
            </th>

            <th class="<?= $orderBy === 'email' ? $currentOrderDir : '' ?>">
                <a>EMAIL</a>
            </th>

            <th class="<?= $orderBy === 'fiscalCode' ? $currentOrderDir : '' ?>">
                <a>FISCAL CODE</a>
            </th>

            <th class="<?= $orderBy === 'age' ? $currentOrderDir : '' ?>">
                <a>AGE</a>
            </th>
            <?php if (userCanUpdate()) { ?>
                <th>
                    MODIFY
                    &nbsp;
                </th>
            <?php } ?>
            <?php if (userCanDelete()) { ?>
                <th>
                    DELETE
                    &nbsp;
                </th>
            <?php } ?>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($users) {
            foreach ($users as $user) { ?>
                <tr>
                    <td><?php
                        if ($user['avatar']) { ?>
                            <img src="<?= $user['avatar'] ?>" alt="avatar" class="img-thumbnail-25">
                        <?php } else { ?>
                            <i class="fa-solid fa-circle-user fa-2xl"> </i>
                        <?php } ?>
                    </td>
                    <td><?= $user['id'] ?></td>
                    <td><?= $user['username'] ?></td>
                    <td><?php if ($user['roleType']) {
                            echo $user['roleType'];
                        } else {
                            echo 'user';
                        } ?></td>
                    <td><a href="mailto:<?= $user['email'] ?>"><?= $user['email'] ?></a></td>
                    <td><?= $user['fiscalCode'] ?></td>
                    <td><?= $user['age'] ?></td>
                    <?php if (userCanUpdate()) { ?>
                        <td>
                            <a class="btn btn-success" href="?id=<?= $user['id'] ?>&action=edit&<?= $pageUrl ?>">
                                <i class="fa fa-pen"></i>
                            </a>
                        </td>
                    <?php } ?>
                    <?php if (userCanDelete()) { ?>
                        <td>
                            <a onclick="return confirm('DELETE USER?')" class="btn btn-danger" href="<?= $updateUrl ?>?id=<?= $user['id'] ?>&action=delete&<?= $pageUrl ?>">
                                <i class="fa fa-trash"></i>
                            </a>
                        </td>
                    <?php } ?>
                </tr>
            <?php } ?>
    <tfoot>
        <div style="text-align: center;">
            <table style="margin: auto;">
                <tr>
                    <td colspan="5">
                        <?php require 'view/navigation.php'; ?>
                        <?= createPagination($totalRecords, $recordsPerPage, $currentPage, $pageUrl, $maxLinks); ?>
                    </td>
                </tr>
            </table>
        </div>
    </tfoot>
<?php
        } else { ?>
    <tr>
        <td colspan="5">NO RECORDS FOUND</td>
    </tr>
<?php } ?>
</tbody>
</table>