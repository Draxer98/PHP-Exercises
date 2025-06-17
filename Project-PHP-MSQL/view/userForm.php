<?php
$action = 'insert';
$buttonName = 'SAVE';
$formTitle = 'INSERT USER';
if($user && $user['id']){
    $action = 'edit';
    $formTitle = 'UPDATE USER';
}
foreach ($user as $value) {
    $value = htmlspecialchars($value);
}
?>
<form action="controller/updateRecord.php" method="post">
    <input type="hidden" name="id" value="<?=$user['id']?>">
    <input type="hidden" name="action" value="<?= $action ?>">
    <h2><?= $formTitle ?></h2>
    <div class="row mb-3">
        <label for="username" class="col-form-label text-end l form-label col-sm-2">Username: </label>
        <div class="col-sm-8">
            <input id="username" value="<?=$user['username']?>" class="col-sm-4 form-control" name="username">
        </div>
    </div>
    <div class="row mb-3">
        <label for="email" class="col-form-label text-end l form-label col-sm-2">Email: </label>
        <div class="col-sm-8">
            <input id="email" value="<?=$user['email']?>" class="col-sm-4 form-control" name="email">
        </div>
    </div>
    <div class="row mb-3">
        <label for="fiscalCode" class="col-form-label text-end l form-label col-sm-2">Fiscal Code: </label>
        <div class="col-sm-8">
            <input id="fiscalCode" value="<?=$user['fiscalCode']?>" class="col-sm-4 form-control" name="fiscalCode">
        </div>
    </div>
    <div class="row mb-3">
        <label for="age" class="col-form-label text-end l form-label col-sm-2">Age: </label>
        <div class="col-sm-8">
            <input id="age" value="<?=$user['age']?>" class="col-sm-4 form-control" name="age">
        </div>
    </div>
    <div class="row mb-3 d-flex justify-content-center aling-items-sm-center">
        <div class="col-sm-3">
            <button href="index.php" type="submit" class="btn btn-primary"> <?= $buttonName ?> </button>
            <a href="index.php" class="btn btn-secondary"> Back to users </a>
            <?php
            if($action === 'edit') { ?>
            <a href="controller/updateRecord.php?action=delete&id=<?= $user['id'] ?>" class="btn btn-danger" onclick="return confirm('Are you sure?')"> Elimina </a>
            <?php } ?>
        </div>
</div>
</form>