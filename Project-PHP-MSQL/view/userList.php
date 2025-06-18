<?php
$currentOrderDir = $currentOrderDir === 'ASC' ? 'DESC' : 'ASC';
?>

<table class="table table-dark table-striped">
    <caption class="caption"><i class="fa-solid fa-users"></i>| USERS LIST | <i class="founds"> <?= $totalRecords ?> records found </i> </caption>
    <thead>
        <tr>
            <th class="<?= $orderBy === 'id' ? $currentOrderDir : '' ?>">
                <a>ID</a>
            </th>

            <th class="<?= $orderBy === 'username' ? $currentOrderDir : '' ?>">
                <a>USERNAME</a>
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
            <th>
                MODIFY
                &nbsp;
            </th>
            <th>
                DELETE
                &nbsp;
            </th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($users) {
            foreach ($users as $user) { ?>
                <tr>
                    <td><?= $user['id'] ?></td>
                    <td><?= $user['username'] ?></td>
                    <td><a href="mailto:<?= $user['email'] ?>"><?= $user['email'] ?></a></td>
                    <td><?= $user['fiscalCode'] ?></td>
                    <td><?= $user['age'] ?></td>
                    <td>
                        <a class="btn btn-success" href="?id=<?= $user['id'] ?>&action=edit&<?= $pageUrl ?>">
                            <i class="fa fa-pen"></i>
                        </a>
                    </td>
                    <td>
                        <a onclick="return confirm('DELETE USER?')" class="btn btn-danger" href="<?= $updateUrl ?>?id=<?= $user['id'] ?>&action=delete&<?= $pageUrl ?>">
                            <i class="fa fa-trash"></i>
                        </a>
                    </td>
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