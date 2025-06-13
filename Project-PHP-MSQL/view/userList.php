<?php
$orderDirClass = $orderDir;
$orderDir = $orderDir === 'ASC' ? 'DESC' : 'ASC';
?>
<table class="table table-dark table-striped">
    <caption class="caption">| USERS LIST |</caption>
    <thead>
        <tr>
            <th class="<?=$orderBy === 'id'? $orderDirClass : ''?>"><a href="?orderBy=id&orderDir=<?=$orderDir?>">ID</a></th>
            <th class="<?=$orderBy === 'username'? $orderDirClass : ''?>"><a href="?orderBy=username&orderDir=<?=$orderDir?>">NAME</a></th>
            <th class="<?=$orderBy === 'email'? $orderDirClass : ''?>"><a href="?orderBy=email&orderDir=<?=$orderDir?>">EMAIL</a></th>
            <th class="<?=$orderBy === 'fiscalCode'? $orderDirClass : ''?>"><a href="?orderBy=fiscalCode&orderDir=<?=$orderDir?>">FISCAL CODE</a></th>
            <th class="<?=$orderBy === 'age'? $orderDirClass : ''?>"><a href="?orderBy=age&orderDir=<?=$orderDir?>">AGE</a></th>
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
                    
                </tr>
        <?php
            }
        } else { ?>
        <tr><td colspan="5">NO RECORDS FOUND</td></tr>
        <?php
        }
        ?>
    </tbody>
</table>